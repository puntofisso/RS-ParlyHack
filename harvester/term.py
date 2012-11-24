from topia.termextract import extract
import operator
import parse


extractor = extract.TermExtractor()
filelist = open('xmlfiles.txt','r').readlines()

d = dict()
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
#for elem in d:
#    name = d[elem]["speakername"]
#    content = str(len(d[elem]["content"]))
#    print name,content

# get the content
#linestring = open('test.txt', 'r').read()

MPs = dict()
for mp in d:
    speakername = d[mp]["speakername"]
    speakerid = str(mp)
    content = d[mp]["content"]
    length = str(len(content))
    l = extractor(content)
    allwords = str(len(l))
    for word in l:
        x = word[0]
        y = word[1]
        z = word[2]
        print '"' + speakername + '","' + speakerid + '","' + str(x) + '","' + str(y) + '","' + str(z) + '","' + allwords + '"'

#x = sorted(l, key=lambda tup: tup[1])




#for i in x:
#    if i[0] not in nowords:
#        print i
