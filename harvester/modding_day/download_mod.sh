#!/bin/sh

#wget -q "http://ukparse.kforge.net/parldata/scrapedxml/debates/" -O debates.html
#grep \"debates debates.html | awk -F"href=\"" {'print $2'} | awk -F "\">debates" {'print $1'} > .list



while read line
do
	url=$line
	wget -q "http://ukparse.kforge.net/parldata/scrapedxml/debates/$url" -O xml/$url
done < .list

