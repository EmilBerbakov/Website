import ujson as json
import pandas as pd
import numpy as np
from file_read_backwards import FileReadBackwards

def keycheck(jsontemp,idval):
    title=jsontemp.get('title')
    subtitle=jsontemp.get('subtitle')
    isbn10=isbncheck(jsontemp.get('isbn_10'),10)
    isbn13=isbncheck(jsontemp.get('isbn_13'),13)
    pages=jsontemp.get('number_of_pages')
    binding=jsontemp.get('physical_format')
    bval=Binding_Check(binding)
    series=jsontemp.get('series')
    dd=idcheck(jsontemp.get('dewey_decimal_class'))
    pd=jsontemp.get('publish_date')
    lccn=idcheck(jsontemp.get('lccn'))
    otherids=jsontemp.get('identifiers')
    if otherids is not None:
        grid=idcheck(otherids.get('goodreads'))
        ltid=idcheck(otherids.get('librarything'))
    else:
        grid=None
        ltid=None
    if series is None:
        series=0
    else:
        series=1
    weight=jsontemp.get('weight')
    dimensions=jsontemp.get('physical_dimensions')
    valuearray=[idval,title,subtitle,isbn10,isbn13,dd,pd,lccn,pages,grid,ltid,bval,series,weight,dimensions]
    return valuearray
    
def Binding_Check(binding):
    if binding is None:
        return 7
    binding=binding.upper()
    match binding:
        case str() if 'HARD' in binding:
            return 1
        case str() if 'MASS' in binding:
            return 2
        case str() if 'MARKET' in binding:
            return 2
        case str() if 'TRADE' in binding:
            return 6
        case str() if 'PAPERBACK' in binding:
            return 3
        case str() if 'KINDLE' in binding:
            return 4
        case ('EBOOK' | 'E-BOOK'):
            return 5
        case _:
            return 7
        
def isbncheck(isbn,flag):
    if isbn is None:
        return None
    match isbn:
        case list() if len(isbn)<1:
            return None
        case list() if len(isbn[0])!=flag:
            return None
        case list() if len(isbn[0])==flag:
            return isbn[0]
        case _:
            return None
            
def idcheck(idval):
    if idval is None:
        return None
    match idval:
        case list() if len(idval)<1:
            return None
        case list() if len(idval)>0:
            return idval[0]
        case _:
            return None

def Edition_Import_2():
    connection_url='mssql+pyodbc://@localhost/Book_Fun?driver=ODBC+Driver+17+for+SQL+Server'
    data=[]
    endvar=0
    lastval=pd.read_sql_query('select top 1 EDITION_ID from EDITION_INFO order by EDITION_ID desc',connection_url).iloc[0][0]
    lastvalactual=f"'{lastval}'"
    print(lastvalactual)
    limit=20000
    with FileReadBackwards('D:/ol_dump_editions_2022-06-06.txt/ol_dump_editions_2022-06-06.txt', encoding='utf-8') as fb:
        for count,line in enumerate(fb):
            jsontemp=json.loads(line.split('\t')[-1])
            idval=f"'{jsontemp.get('key').split('/')[-1]}'"
            if ((idval==lastvalactual)or(len(data)>=limit)):
                df=pd.DataFrame(data,columns=['EDITION_ID','TITLE','SUBTITLE','ISBN_10','ISBN_13','DD_NUMBER','PUBLICATION_YEAR','LCC_ID','PAGE_COUNT','GR_ID','LT_ID','BINDING_C','SERIES_YN','WEIGHT','DIMENSIONS'])
                total=(df.size)/3
                print('DataFrame complete. Beginning upload of '+str(total)+' rows')
                df.to_sql('EDITION_INFO',connection_url,if_exists="append",index=False,chunksize=5000)
                del data,df
                data=[]
                if idval==lastvalactual:
                    return
            else:
                valuearray=keycheck(jsontemp,idval)
                del jsontemp
                data.append(valuearray)
                
                  

Edition_Import_2()
#If I want to use Vaex, I will have to use a Python version under 3.10, which means no switch statements