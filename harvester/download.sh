#!/bin/sh

wget -q "http://ukparse.kforge.net/parldata/scrapedxml/debates/" -O debates.html
grep \"debates debates.html | awk -F"href=\"" {'print $2'} | awk -F "\">debates" {'print $1'} > .list

start_year="2012"
start_month="05"
start_day="18"

while read line
do
	# debates2012-11-20a.xml
	year=`echo $line | awk -F"debates" {'print $2;'} | awk -F"-" {'print $1'}`
	month=`echo $line | awk -F"-" {'print $2'}`
 	day=`echo $line | awk -F"-" {'print $3'} | cut -c1-2`
 	variant=`echo $line | awk -F"-" {'print $3'} | cut -c3-3`
	url=$line
	#echo $year,$month,$day,$variant
	if [ $year -ge $start_year ]
	then
		if [ $month -ge $start_month ]
		then
			if [ $day -ge $start_day ] 
			then 
				wget -q "http://ukparse.kforge.net/parldata/scrapedxml/debates/$url" -O xml/$url
			fi
		fi 
	fi
done < .list

