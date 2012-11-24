from topia.termextract import extract
import operator
import parse

MPs = dict()


extractor = extract.TermExtractor()
filelist = open('xmlfiles.txt','r').readlines()


for myfile in filelist:
    filelocation = myfile.strip()
    d = parse.parseXML(filelocation)
    #print "===After " + myfile


    for elem in d:
        name = "NOTSET"
        try:
            name = d[elem]["speakername"]
        except Exception, error:
            name = "ERRORNAME"
        content = d[elem]["content"]
        count = 0
        try:
            count = len(content)
        except Exception, error:
            count = 0

        #print elem + ": " + str(name) +": " +str(count)

for elem in d:
    name = d[elem]["speakername"]
    content = str(len(d[elem]["content"]))
    print name,content

# get the content
#linestring = open('test.txt', 'r').read()
#l = extractor(linestring)



#x = sorted(l, key=lambda tup: tup[1])

#nowords = ['constituency','Minister','honourable','Prime Minister','Prime','hon','right','friend']


#for i in x:
#    if i[0] not in nowords:
#        print i
