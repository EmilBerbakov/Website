import os
import concurrent.futures
import ujson as json
import gzip
import pandas as pd
import isbn_validator as iv
import numpy as np
def prepandsend(path):
    data=[]
    connection_url='mssql+pyodbc://@localhost/Book_Fun?driver=ODBC+Driver+17+for+SQL+Server'
    for file in os.listdir(path):
        filename=os.fsdecode(file)
        if filename.endswith('.txt.gz'):
            data=[]
            f=gzip.open(os.path.join(path,filename),'rt',newline='\r\n',encoding='utf-8')
            #print('Processing ',fp)
            for ln,content in enumerate(f):
                jsontemp=json.loads(content)
                if (isinstance(jsontemp,dict)==False):
                    continue
                idvalcheck=jsontemp.get('key')
                isbn10check=jsontemp.get('isbn_10')
                isbn13check=jsontemp.get('isbn_13')
                if ((idvalcheck is None) or((isbn10check is None)and(isbn13check is None))):
                    continue
                idval=idvalcheck.split('/')[-1]
                if (idval is None) or (idval.startswith('OL')==False) or (idval.endswith('M')==False):
                    continue
                isbn10=isbncheck(isbn10check,10)
                isbn13=isbncheck(isbn13check,13)
                if ((isbn10 is None) and (isbn13 is None)):
                    continue
                title=jsontemp.get('title')
                subtitle=jsontemp.get('subtitle')
                data.append([idval,title,subtitle,isbn10,isbn13])
                #print('ID data type: ',type(idval),' Title: ',type(title),' Subtitle: ',type(subtitle),' isbn10: ',type(isbn10),' isbn13: ',type(isbn13))
                del idval,isbn10,isbn13
            #datanp=np.array(data,dtype=object)
            #print('aRE we getting here?')
            df=pd.DataFrame(data,columns=['EDITION_ID','TITLE','SUBTITLE','ISBN_10','ISBN_13'])
            print('Uploading ',str(len(df.index)),' records to SQL server...')
            df.to_sql('EDITION_INFO_2',connection_url,if_exists='append',index=False,method='multi',chunksize=100)
            print('Chunk upload of ',filename,' complete')
            del df,data

def isbncheck(isbnlist,flag):
    if isbnlist is None:
        return None
    if len(isbnlist)<1:
        return None
    if ((iv.is_valid_isbn(isbnlist[0])==True) and (len(isbnlist[0])==flag)):
        isbnnumlist=iv._clean_isbn(isbnlist[0])
        if ((isbnnumlist[-1]==10) and(len(isbnnumlist)==10)):
            isbnnumlist[-1]='X'
        isbnnum=''.join(map(str,isbnnumlist))      
        return isbnnum
    return None
    
prepandsend('D:/EditionJsons')