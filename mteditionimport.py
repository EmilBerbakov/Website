import os
import concurrent.futures
import ujson as json
import gzip
import pandas as pd
import isbn_validator as iv
import numpy as np

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
        del idval,isbn10,isbn13
    datanp=np.array(data,dtype=object)
    df=pd.DataFrame(datanp,columns=['EDITION_ID','TITLE','SUBTITLE','ISBN_10','ISBN_13'])
    print('Uploading ',str(len(df.index)),' records to SQL server...')
    df.to_sql('EDITION_INFO_2',connection_url,if_exists='append',index=False,method='multi',chunksize=100)
    print('Chunk upload of,',fp, ' complete')
    del df,data

def isbncheck(isbnlist,flag):
    if isbnlist is None:
        return None
    if len(isbnlist)<1:
        return None
        #I also can't rely on the ISBNs being in their proper place, as it seems ISBN-13s are sometimes in the ISBN-10 dictionary, or publishers mess up and say that a 13 digit ISBN is the ISBN-10.  Because of this, I'll have to do some extra validation...
    if ((iv.is_valid_isbn(isbnlist[0])==True) and (len(isbnlist[0])==flag)):
        #This part used to happen before validation.  Due to the data in the isbn keys being randomly bad sometimes, (say the string 'two' as a random example) the routine would error out attempting to get the last position of the empty list iv._clean_isbn would spit out.
        isbnnumlist=iv._clean_isbn(isbnlist[0])
        if ((isbnnumlist[-1]==10) and(len(isbnnumlist)==10)):
            isbnnumlist[-1]='X'
        isbnnum=''.join(map(str,isbnnumlist))      
        return isbnnum
    return None

getfiles('D:/EditionJsons')

with concurrent.futures.ThreadPoolExecutor(max_workers=8) as executor:
    future_prepandsend={executor.submit(prepandsend,filetouse):filetouse for filetouse in filelist}
    for future in concurrent.futures.as_completed(future_prepandsend):
        filetouse=future_prepandsend[future]