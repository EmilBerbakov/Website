import pandas as pd
import csv

def Work_json(file):
    data=[]
    with pd.read_csv(file,compression='gzip',usecols=[4],header=None,sep='\t',index_col=False,chunksize=10) as reader:
        for i,chunk in enumerate(reader):
         chunk.to_csv(f'D:/EditionJsons/Edition_{i}_.txt.gz','\t',compression='gzip',index=False,quoting=csv.QUOTE_NONE,quotechar="")
Work_json('D:/Downloads/editions.txt.gz')
           