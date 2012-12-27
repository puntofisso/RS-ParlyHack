#!/bin/sh
BASE_DIR="/Users/puntofisso/Desktop/DEV/chaMPion/RS-ParlyHack/"
key="CPmndLARaZ76DJLwuiB7ZqQ7"
DB_HOST="localhost"
DB_NAME="RS-ParlyHack"
DB_USER="rewired"
DB_PASS="rewired"
MYSQL_PATH="/Applications/MAMP/Library/bin/"

# download xml
sh download.sh

# parse
ls -l xml/ | grep xml | awk {'print "xml/"$9'} > xmlfiles.csv
python term.py > Keywords.csv

# create lookahead
while read line; do echo $line | awk -F "\",\"" {'print $3;'}; done < Keywords.csv > .words ; sort .words | uniq > words.csv
rm -f .words



# update mp list
wget -q "http://www.theyworkforyou.com/api/getMPs&key=$key" -O all_mps.json
python parse_mps.py > MPs.csv

# truncate Keywords
$MYSQL_PATH/mysql -u$DB_USER -p$DB_PASS -e "truncate Keywords" $DB_NAME
# truncate MPs
$MYSQL_PATH/mysql -u$DB_USER -p$DB_PASS -e "truncate MPs" $DB_NAME

# put words in db
$MYSQL_PATH/mysqlimport --fields-enclosed-by='"' --fields-terminated-by=',' --lines-terminated-by='\n' --local --columns=name,id,keyword,x,y,total -u $DB_USER $DB_NAME Keywords.csv -p$DB_PASS
# put MPs in db
$MYSQL_PATH/mysqlimport --fields-enclosed-by='"' --fields-terminated-by=',' --lines-terminated-by='\n' --local --columns=NAME,MEMBER_ID,PERSON_ID,PARTY,CONSTITUENCY -u $DB_USER $DB_NAME MPs.csv -p$DB_PASS

# clean DB Keywords
$MYSQL_PATH/mysql -u$DB_USER -p$DB_PASS -e "DELETE from Keywords where name='PYTHONNONE'" $DB_NAME
$MYSQL_PATH/mysql -u$DB_USER -p$DB_PASS -e "DELETE from Keywords where keyword='right'" $DB_NAME
$MYSQL_PATH/mysql -u$DB_USER -p$DB_PASS -e "DELETE from Keywords where keyword='hon'" $DB_NAME
