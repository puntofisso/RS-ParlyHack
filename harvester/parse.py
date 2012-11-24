import lxml
import urllib2
from lxml import etree
from xml.dom.minidom import parse, parseString


my_dict = dict()

def parseXML(xmlFile):
    global my_dict

    tree = etree.parse(xmlFile)
    root = tree.getroot()
    entries = root.xpath('//speech') #,namespaces={'def':'http://www.w3.org/2005/Atom',})
 
    for entry in entries:

        try:
            speakername = entry.get('speakername')
        except Exception, error:
            speakername = "NONENAME"
        try:
            speakerid = entry.get('speakerid')
        except Exception, error:
            speakerid = "NONEID"

        if speakerid == "None":
            speakerid = "WASNONE"
     
        if speakerid is None:
            speakerid = "PYTHONNONE"

        if speakername == "None":
            speakername = "WASNONE"
     
        if speakername is None:
            speakername = "PYTHONNONE"



        text_nodes = entry.xpath('p[@pid]')
        content = ""
        try:
            for text in text_nodes:
                content = content + (text.text).encode('utf-8')
        except Exception, err:
                content = "ERROR"
        
        if (speakerid in my_dict):
            my_dict[speakerid]["content"] = my_dict[speakerid]["content"] + content
        else:
            my_dict[speakerid] = dict()
            my_dict[speakerid]["speakername"] = speakername.encode('utf-8')
            my_dict[speakerid]["content"] = content

    return my_dict

