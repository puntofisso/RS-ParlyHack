import urllib2
import cookielib
import sys
import json
import re
import string
#read mps, load url, parse resulting text

# I download to a file as it's easier for debug later, but this can be moved to a proper script

mps_text = open("all_mps.json", "r").read()
mps = json.loads(mps_text.decode('utf-8','ignore'))
print "NAME,MEMBER_ID,PERSON_ID,PARTY,CONSTITUENCY"
for mp in mps:
    name = mp["name"]
    member_id = mp["member_id"]
    person_id = mp["person_id"]
    party = mp["party"]
    constituency = mp["constituency"]
    print name+","+member_id+","+person_id+","+party+","+constituency   


