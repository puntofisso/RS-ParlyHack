
import sys
import json
import re
import string
#read mps, load url, parse resulting text
mps_text = open("all_mps", "r").read()


mps = json.loads(mps_text.decode('utf-8'))

print "NAME,MEMBER_ID,PERSON_ID,PARTY,CONSTITUENCY"
for mp in mps:
    name = mp["name"]
    member_id = mp["member_id"]
    person_id = mp["person_id"]
    party = mp["party"]
    constituency = mp["constituency"]
    print name+","+member_id+","+person_id+","+party+","+constituency   

#password = mps["member_id"]["pass"] 
#database = mps["db"]["name"] 
#hostname = mps["db"]["host"] 

