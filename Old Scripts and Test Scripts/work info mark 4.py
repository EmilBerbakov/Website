import ujson as json
import pandas as pd
import numpy as np
from file_read_backwards import FileReadBackwards


def Work_Import_2():
    connection_url='mssql+pyodbc://@localhost/Book_Fun?driver=ODBC+Driver+17+for+SQL+Server'
    data=[]
    endvar=0
    limit=1000000
    lastval=pd.read_sql_query('select top 1 WORK_ID from WORK_INFO order by WORK_ID desc',connection_url).iloc[0][0]
    lastvalactual=f"'{lastval}'"
    with FileReadBackwards('D:/Downloads/ol_dump_works_2022-06-06.txt', encoding='utf-8') as fb:
        for count,line in enumerate(fb):
            jsontemp=json.loads(line.split('\t')[-1])
            idval=f"'{jsontemp.get('key').split('/')[-1]}'"
            if idval==lastvalactual:
                df=pd.DataFrame(data,columns=['WORK_ID','TITLE','SUBTITLE'])
                total=(df.size)/3
                print('DataFrame complete. Beginning upload of '+str(total)+' rows')
                df.to_sql('WORK_INFO',connection_url,if_exists="append",index=False,chunksize=5000)
                return
            else:
                    data.append([idval,jsontemp.get('title'),jsontemp.get('subtitle')])

                  

Work_Import_2()