import os
import concurrent.futures
import ujson as json
import gzip
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
    f=gzip.open(fp,'rt',newline='\r\n',encoding='utf-8')
    print('Processing ',fp)
    for ln,content in enumerate(f):
        jsontemp=json.loads(content)
        if (isinstance(jsontemp,dict)==False):
            continue
        try:
            authidlist=jsontemp.get('authors')
            workid=jsontemp.get('key').split('/')[-1]
        except:
            continue
        if ((workid.startswith('OL')==False)or(workid.endswith('W')==False)):
            continue
        try:
            for i in range(len(authidlist)):
                authid=authidlist[i].get('author')['key'].split('/')[-1]
                if ((authid.startswith('OL')==False)or(authid.endswith('A')==False)):
                    continue
                data.append([workid,authid])
        except:
            continue
    df=pd.DataFrame(data,columns=['WORK_ID','AUTHOR_ID'])
    print('Uploading ',str(len(df.index)),' records to SQL server...')
    df.to_sql('WORK_TO_AUTHOR',connection_url,if_exists='append',index=False,method='multi',chunksize=100)
    print('Chunk upload of,',fp, ' complete')
    del df,data
                     
getfiles('D:/WorkJsons')

with concurrent.futures.ThreadPoolExecutor(max_workers=8) as executor:
    future_prepandsend={executor.submit(prepandsend,filetouse):filetouse for filetouse in filelist}
    for future in concurrent.futures.as_completed(future_prepandsend):
       filetouse=future_prepandsend[future]
       