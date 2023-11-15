import functions_framework
import wbgapi as wb
import pandas as pd
from google.cloud import bigquery

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

    ids = ['NY.GDP.PCAP.CD','NY.GDP.MKTP.KD.ZG','NY.GNP.PCAP.CD','NE.RSB.GNFS.CD','GC.XPN.TOTL.GD.ZS',
        'SH.XPD.GHED.GD.ZS','SH.DYN.NMRT','SE.XPD.TOTL.GD.ZS','SE.XPD.PRIM.PC.ZS','SE.ADT.LITR.ZS',
        'GB.XPD.RSDV.GD.ZS','SP.POP.SCIE.RD.P6','IP.PAT.RESD','SI.POV.GINI','SI.POV.NAHC',
        'SL.UEM.TOTL.ZS','VC.IHR.PSRC.P5','SP.DYN.LE00.IN']

    countriesSelected30 = ['USA','CHN','JPN','AUS','DEU','CHE','ESP','CAN','FRA','NOR',
                        'KOR','NZL','FIN','GBR','SGP','IND','ARG','BRA','URY','CHL',
                        'BOL','PER','CUB','VEN','MEX','COL','PRI','SLV','QAT','SYR']
    
    df_hechos = wb.data.DataFrame(ids,countriesSelected30, mrv=35)

    df_hechos_org = df_hechos.loc[('ARG',),:].T
    country = ['ARG']*len(df_hechos_org)
    df_hechos_org = df_hechos_org.reset_index()
    df_hechos_org['year'] = df_hechos_org['index'].str.slice(2,).astype(int)
    df_hechos_org.drop(columns='index',inplace=True)
    df_hechos_org['country'] = country

    for c in countriesSelected30[1:]:
        df_hechos_c = df_hechos.loc[(c,),:].T
        country = [c]*len(df_hechos_c)
        df_hechos_c = df_hechos_c.reset_index()
        df_hechos_c['year'] = df_hechos_c['index'].str.slice(2,).astype(int)
        df_hechos_c.drop(columns='index',inplace=True)
        df_hechos_c['country'] = country

        df_hechos_org = pd.concat([df_hechos_org,df_hechos_c],ignore_index=True)

    df_hechos_final = pd.DataFrame(df_hechos_org.values,columns=df_hechos_org.columns.str.replace('.','_'))

    print("Tabla creada, pasando a BigQuery.")

    # Pasar a bigquery
    
    table_id = "rare-lambda-404112.worldBank.hechos"

    client = bigquery.Client()

    job_config = bigquery.LoadJobConfig(
        schema=[
            bigquery.SchemaField("country", bigquery.enums.SqlTypeNames.STRING),
        ],
        write_disposition="WRITE_TRUNCATE",
    )

    job = client.load_table_from_dataframe(
        df_hechos_final, table_id, job_config=job_config
    )

    job.result()

    table = client.get_table(table_id)
    print(
        "Loaded {} rows and {} columns to {}".format(
            table.num_rows, len(table.schema), table_id
        )
    )

    
