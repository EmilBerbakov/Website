import ujson as json
import pandas as pd
import gzip
import os
def infostrip(path):
    connection_url='mssql+pyodbc://@localhost/Book_Fun?driver=ODBC+Driver+17+for+SQL+Server'
    for file in os.listdir(path):
        filename=os.fsdecode(file)
        if filename.endswith('.txt.gz'):
            data=[]
            f=gzip.open(os.path.join(path,filename),'rt',newline='\r\n',encoding='utf-8')
            print('Beginning work on ',filename)
            for ln,content in enumerate(f):
                jsontemp=json.loads(content)
                if isinstance(jsontemp,dict):
                    idval=jsontemp.get('key').split('/')[-1]
                    title=jsontemp.get('title')
                    subtitle=jsontemp.get('subtitle')
                    if ((idval!='') or (title!='')):
                        data.append([idval,title,subtitle])
                    del idval,title,subtitle
            df=pd.DataFrame(data,columns=['WORK_ID','TITLE','SUBTITLE'])
            print('upload of ',str(len(df.index)),' records to SQL server beginning.')
            df.to_sql('WORK_INFO',connection_url,if_exists="append",index=False,method='multi',chunksize=100)
            print('upload of these records complete.')
            del df,data
        print(filename,' upload complete')
    print('All records uploaded to SQL server')
infostrip('D:/WorkJsons')




