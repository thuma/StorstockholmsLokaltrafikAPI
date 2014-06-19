# -*- coding: utf-8 -*-
import urllib2
key = ""
get = urllib2.urlopen('http://api.sl.se/api2/FileService?key='+key+'&filename=Sites.csv')
sites = get.read().split('\n')
get = urllib2.urlopen('http://api.sl.se/api2/FileService?key='+key+'&filename=StopPoints.csv')
points = get.read().split('\n')

siteid = {}
alla = {}

for site in sites:
  colls = site.strip().split(';')
  siteid[colls[2]] = colls

for point in points:
  colls = point.strip().split(';')
  alla[colls[0]] = {}
  alla[colls[0]]['point'] = colls
  try:
    alla[colls[0]]['site'] = siteid[colls[2]]
  except:
    alla[colls[0]]['site'] = ['Missing','Missing']

for en in alla:
  en =  alla[en]
  print en['point'][0]+';'+en['point'][1]+';'+en['point'][2]+';'+en['point'][3]+';'+en['point'][4]+';'+en['point'][5]+';'+en['point'][6]+';'+en['point'][7]+';'+en['point'][8]+';'+en['site'][0]+';'+en['site'][1]
