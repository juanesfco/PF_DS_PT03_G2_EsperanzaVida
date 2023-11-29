import functions_framework
import wbgapi as wb
import pandas as pd
from google.cloud import bigquery
from google.cloud import storage
from pyjstat import pyjstat
from statsmodels.tsa.arima.model import ARIMA
import numpy as np

# Triggered by a change in a storage bucket
@functions_framework.cloud_event
def hello_gcs(cloud_event):
    data = cloud_event.data

    event_id = cloud_event["id"]
    event_type = cloud_event["type"]

    bucket = data["bucket"]
    name = data["name"]
    metageneration = data["metageneration"]
    timeCreated = data["timeCreated"]
    updated = data["updated"]

    #print(f"Event ID: {event_id}")
    #print(f"Event type: {event_type}")
    #print(f"Bucket: {bucket}")
    #print(f"File: {name}")
    #print(f"Metageneration: {metageneration}")
    #print(f"Created: {timeCreated}")
    print(f"Cambio identificado en: {updated}")

    # Crear tabla

    print("Creando tabla")

    countriesSelected30 = ['USA','CHN','JPN','AUS','DEU','CHE','ESP','CAN','FRA','NOR',
                        'KOR','NZL','FIN','GBR','SGP','IND','ARG','BRA','URY','CHL',
                        'BOL','PER','CUB','VEN','MEX','COL','DOM','SLV','QAT','SYR']

    recentYears = 100

    df_indicatorsDownload = pd.read_csv('https://raw.githubusercontent.com/juanesfco/PF_DS_PT03_G2_EsperanzaVida/main/Data/indicatorsDownload.tsv')
    indicatorsDownload = df_indicatorsDownload.iloc[:,0].values

    client = bigquery.Client()

    df_countries_table = client.get_table('rare-lambda-404112.worldBank.countries')
    df_countries = client.list_rows(df_countries_table).to_dataframe()

    df_countries_selected_names = df_countries[df_countries['country_id'].isin(countriesSelected30)]['country'].values
    df_countries_selected_ids = df_countries[df_countries['country_id'].isin(countriesSelected30)]['country_id'].values

    df_facts = pd.DataFrame(columns=['Country','Series','Year','value'])

    storage_client = storage.Client()
    bucket = storage_client.get_bucket('worldbank-datalake')
    for url in indicatorsDownload:

        indicator = url[50:url.find('?f')]
        di = 'api.worldbank.org/v2/country/all/indicator/' + indicator

        blob = bucket.blob(di)
        contents = blob.download_as_string()
        dataset_from_json_string = pyjstat.Dataset.read(contents.decode("utf-8"))
        df = dataset_from_json_string.write('dataframe')

        df['Series'] = [indicator]*len(df)

        df_c = df[df['Country'].isin(df_countries_selected_names)]
        df_cm = df_c.copy()
        df_cm['Country'] = df_c['Country'].replace(df_countries_selected_names,df_countries_selected_ids)

        df_cmy = df_cm[(2022-df_cm['Year'].astype(int))<recentYears]

        df_facts = pd.concat([df_facts,df_cmy],ignore_index=True)
    
    df_facts.rename(columns={'Country':'country_id','Series':'series_id','Year':'year'},inplace=True)

    df_facts_30 = df_facts[df_facts['year'].astype(int)>=1993]
    df_facts_null = df_facts_30[df_facts_30['value'].isna()]
    series = df_facts_null['series_id'].unique()
    countries = df_facts_null['country_id'].unique()
    naSummary = pd.DataFrame(columns=['country_id','series','#NaN'])
    for c in countries:
        df_facts_null_c = df_facts_null[df_facts_null['country_id']==c]
        for s in series:
            df_facts_null_cs = df_facts_null_c[df_facts_null_c['series_id']==s]
            l = sum(df_facts_null_cs['value'].isna())
            if l > 0:
                naSummary = pd.concat([naSummary,pd.DataFrame([[c,s,l]],columns=['country_id','series','#NaN'])],ignore_index=True)

    naSummaryLess10 = naSummary[naSummary['#NaN']<30]

    for i in range(len(naSummaryLess10)):
        c = naSummaryLess10.iloc[i,0]
        s = naSummaryLess10.iloc[i,1]
        df_facts_cs = df_facts[(df_facts['country_id']==c)&(df_facts['series_id']==s)]

        #print(df_facts_cs)
        
        y = df_facts_cs['value'].values
        ARIMAmodel = ARIMA(y, order = (1, 0, 1))
        ARIMAmodel = ARIMAmodel.fit()

        indexNaN = df_facts_cs[df_facts_cs['value'].isna()].index
        for j in indexNaN:
            year = int(df_facts_cs.loc[j,'year'])
            if year >= 1993:
                x = year - 1960
                y_pred = ARIMAmodel.predict(x)
                #print('Imputation on country: ',c,', series: ',s,', year: ',str(year),' and value: ',y_pred[0])

                df_facts_cs.loc[j,'value'] = y_pred[0]

        df_facts[(df_facts['country_id']==c)&(df_facts['series_id']==s)] = df_facts_cs

    df_facts_30 = df_facts[df_facts['year'].astype(int)>=1993]

#################################

    #ids = ['NY.GDP.PCAP.CD','NY.GDP.MKTP.KD.ZG','NY.GNP.PCAP.CD','NE.RSB.GNFS.CD','GC.XPN.TOTL.GD.ZS',
    #    'SH.XPD.GHED.GD.ZS','SH.DYN.NMRT','SE.XPD.TOTL.GD.ZS','SE.XPD.PRIM.PC.ZS','SE.ADT.LITR.ZS',
    #    'GB.XPD.RSDV.GD.ZS','SP.POP.SCIE.RD.P6','IP.PAT.RESD','SI.POV.GINI','SI.POV.NAHC',
    #    'SL.UEM.TOTL.ZS','VC.IHR.PSRC.P5','SP.DYN.LE00.IN']

    #countriesSelected30 = ['USA','CHN','JPN','AUS','DEU','CHE','ESP','CAN','FRA','NOR',
    #                    'KOR','NZL','FIN','GBR','SGP','IND','ARG','BRA','URY','CHL',
    #                    'BOL','PER','CUB','VEN','MEX','COL','PRI','SLV','QAT','SYR']
    
    #df_hechos = wb.data.DataFrame(ids,countriesSelected30, mrv=35)

    #df_hechos_org = df_hechos.loc[('ARG',),:].T
    #country = ['ARG']*len(df_hechos_org)
    #df_hechos_org = df_hechos_org.reset_index()
    #df_hechos_org['year'] = df_hechos_org['index'].str.slice(2,).astype(int)
    #df_hechos_org.drop(columns='index',inplace=True)
    #df_hechos_org['country'] = country

    #for c in countriesSelected30[1:]:
    #    df_hechos_c = df_hechos.loc[(c,),:].T
    #    country = [c]*len(df_hechos_c)
    #    df_hechos_c = df_hechos_c.reset_index()
    #    df_hechos_c['year'] = df_hechos_c['index'].str.slice(2,).astype(int)
    #    df_hechos_c.drop(columns='index',inplace=True)
    #    df_hechos_c['country'] = country

    #    df_hechos_org = pd.concat([df_hechos_org,df_hechos_c],ignore_index=True)

    #df_hechos_final = pd.DataFrame(df_hechos_org.values,columns=df_hechos_org.columns.str.replace('.','_'))

    print("Tabla creada, pasando a BigQuery.")

    # Pasar a bigquery
    
    #table_id = "rare-lambda-404112.worldBank.hechos"
    table_id = "rare-lambda-404112.worldBank.facts"

    #client = bigquery.Client()

    job_config = bigquery.LoadJobConfig(
        schema=[
            bigquery.SchemaField("country_id", bigquery.enums.SqlTypeNames.STRING),
            bigquery.SchemaField("series_id", bigquery.enums.SqlTypeNames.STRING),
        ],
        write_disposition="WRITE_TRUNCATE",
    )
    print('ahora viene el error')
    job = client.load_table_from_dataframe(
        df_facts_30, table_id, job_config=job_config
    )

    job.result()

    table = client.get_table(table_id)
    print(
        "Loaded {} rows and {} columns to {}".format(
            table.num_rows, len(table.schema), table_id
        )
    )