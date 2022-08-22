import os

def test(directory):
    for file in os.listdir(directory):
        filename=os.fsdecode(file)
        if filename.endswith('.txt.gz'):
            print(os.path.join(directory,file))
        else:
            print(filename," isn't a .txt.gz file")
        
test('D:/WorkJsons')