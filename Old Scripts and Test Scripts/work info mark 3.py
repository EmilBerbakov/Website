import ujson as json
import pandas as pd
import numpy as np
from file_read_backwards import FileReadBackwards


def Work_Import_2():
    connection_url='mssql+pyodbc://@localhost/Book_Fun?driver=ODBC+Driver+17+for+SQL+Server'
    data=[]
    endvar=0
    with FileReadBackwards('D:/Downloads/ol_dump_works_2022-06-06.txt', encoding='utf-8') as fb:
        for count,line in enumerate(fb):
            if endvar==1:
                break
            jsontemp=json.loads(line.split('\t')[-1])
            idval=f"'{jsontemp.get('key').split('/')[-1]}'"
            test=pd.read_sql_query('if exists(select top 1 * from WORK_INFO where WORK_ID='+idval+') begin select 1 end else begin select 0 end',connection_url)
            match test.iloc[0][0]:
                case 1:
                    endvar=1
                    break
                case 0:
                    data.append([idval,jsontemp.get('title'),jsontemp.get('subtitle')])
                    print(idval+' exists!')
    total=(df.size)/3
    df=pd.DataFrame(data,columns=['WORK_ID','TITLE','SUBTITLE'],index='WORK_ID')
    print('DataFrame complete. Beginning upload of '+str(total)+' rows')
    df.to_sql('WORK_INFO',connection_url,if_exists=append,index=True,index_label='WORK_ID',chunksize=5000)
                  

Work_Import_2()