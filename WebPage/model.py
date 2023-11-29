import sys
import joblib
import pandas as pd

same_pipe = joblib.load('pipe.joblib')
cols = same_pipe.feature_names_in_

X1 = float(sys.argv[1]) #ano
X2 = float(sys.argv[2]) #patentes
X3 = float(sys.argv[3]) #bal_comercial
X4 = float(sys.argv[4]) #PIB_crec
X5 = float(sys.argv[5]) #PIB_pc
X6 = float(sys.argv[6]) #INB_pc
X7 = float(sys.argv[7]) #educacion
X8 = float(sys.argv[8]) #mortalidad
X9 = float(sys.argv[9]) #salud
X10 = float(sys.argv[10]) #desempleo
X11 = float(sys.argv[11]) #homicidios

Xin = pd.DataFrame([[X1,X2,X3,X4,X5,X6,X7,X8,X9,X10,X11]],columns=cols)

print(round(same_pipe.predict(Xin)[0],2))