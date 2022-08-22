#for this code, I will be looping through the Work files.
#grab "key".split('/')[-1]
#grab "authors".  Check if null or empty
#get length of "authors"
#for each "key" in "authors", "key".split('/')[-1], then add workid and authorid to a list and append the empty list data
#turn data into a dataframe, then upload

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
            workid=jsontemp.get('key').split('/')[-1]
            authoridvalcheck=jsontemp.get('authors')
        except:
            continue
        if ((workid is None)or (authoridvalcheck is None)):
            continue
        if ((workid.startswith('OL')==False)or(workid.endswith('M')==False)):
            continue
        if len(authoridvalcheck)<1:
            continue
        for fn in authoridvalcheck:
            try:
                authid=fn.get('key').split('/')[-1]
            except:
                continue
            if ((authid.startswith('OL')==False)or(authid.endswith('A')==False)):
                continue
            data.append([workid,authid])
    df=pd.DataFrame(data,columns=['EDITION_ID','AUTHOR_ID'])
    print('Uploading ',str(len(df.index)),' records to SQL server...')
    df.to_sql('EDITION_TO_AUTHOR',connection_url,if_exists='append',index=False,method='multi',chunksize=100)
    print('Chunk upload of,',fp, ' complete')
    del df,data
       
#this might not work the way I have it right now
#when the book only has one author, it's fine
#The issue arrises with more than one:
#[['OL28615470M', 'OL7799526A'], ['OL28615470M', 'OL8093793A']]
#I originally had the whole looping through the authors list as its own routine.  data was a global so I could easily append to it and it would maintain its needed 'list of lists with two entries' shape.  Unfortunately, doing that meant that, upon multithreading, each thread saw data update and be deleted by other processes.  So, back into the one routine we go.
    
      
getfiles('D:/EditionJsons')

with concurrent.futures.ThreadPoolExecutor(max_workers=8) as executor:
    future_prepandsend={executor.submit(prepandsend,filetouse):filetouse for filetouse in filelist}
    for future in concurrent.futures.as_completed(future_prepandsend):
       filetouse=future_prepandsend[future]
       
       
#so, this method works for Editions.  Unfortunately, the same cannot be said for Works.
#Works have authors stored a bit differently, it seems...
