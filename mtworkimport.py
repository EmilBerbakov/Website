#let's try multithreading!
import os
import concurrent.futures
import ujson as json
import gzip
#from guppy import hpy
import pandas as pd
def getfiles(path):
    global filelist
    filelist=[]
    for file in os.listdir(path):
        filename=os.fsdecode(file)
        if filename.endswith('.txt.gz'):
            filelist.append(os.path.join(path,filename))
            
def prepandsend(fp):
    data=[]
    connection_url='mssql+pyodbc://@localhost/Book_Fun?driver=ODBC+Driver+17+for+SQL+Server'
    f=gzip.open(fp,'rt',newline='\r\n')
    #h=hpy()
    print('Processing ',fp)
    for ln,content in enumerate(f):
        jsontemp=json.loads(content)
        if isinstance(jsontemp,dict):
            idval=jsontemp.get('key').split('/')[-1]
            if idval is None:
                break
            title=jsontemp.get('title')
            if title is None:
                break
            subtitle=jsontemp.get('subtitle')
            data.append([idval,title,subtitle])
            #if ((fp=='D:/WorkJsons/Work_25_.txt.gz') and (ln%10000==0)):
            #   h.heap()
            del idval,title,subtitle
    df=pd.DataFrame(data,columns=['WORK_ID','TITLE','SUBTITLE'])
    print('Uploading ',str(len(df.index)),' records to SQL server...')
    df.to_sql('WORK_INFO',connection_url,if_exists='append',index=False,method='multi',chunksize=100)
    print('Chunk upload complete.')
    del df,data
    
 
getfiles('D:/WorkJsons')    

with concurrent.futures.ThreadPoolExecutor(max_workers=8) as executor:
    future_prepandsend={executor.submit(prepandsend,filetouse):filetouse for filetouse in filelist}
    for future in concurrent.futures.as_completed(future_prepandsend):
        filetouse=future_prepandsend[future]
       