import ujson as json
import pandas as pd
import numpy as np

def Work_Import_2(file):
    connection_url='mssql+pyodbc://@localhost/Book_Fun?driver=ODBC+Driver+17+for+SQL+Server'
    startfile=open(file)
    data=[]
    
    for count,line in enumerate(startfile):
        jsontemp=json.loads(line.split('\t')[-1])
        idval=f"'{jsontemp.get('key').split('/')[-1]}'"
        test=pd.read_sql_query('if exists(select top 1 * from WORK_INFO where WORK_ID='+idval+') begin select 1 end else begin select 0 end',connection_url)
        match test.iloc[0][0]:
            case 1:
                pass
            case 0:
                data.append([idval,jsontemp.get('title'),jsontemp.get('subtitle')])
    startfile.close()
    total=(df.size)/3
    df=pd.DataFrame(data,columns=['WORK_ID','TITLE','SUBTITLE'],index='WORK_ID')
    print('DataFrame complete. Beginning upload of '+str(total)+' rows')
    df.to_sql('WORK_INFO',connection_url,if_exists=append,index=True,index_label='WORK_ID',chunksize=5000)
                  

Work_Import_2('D:/Downloads/ol_dump_works_2022-06-06.txt')