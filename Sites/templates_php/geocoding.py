import sys
from opencage.geocoder import OpenCageGeocode
import csv

key = 'e0449567eaaf40c68c95e7238d390381'
geocoder = OpenCageGeocode(key)

with open('Sites/templates_php/data_direcciones.csv', newline='') as csvfile:
    reader = csv.DictReader(csvfile)
    for row in reader:
        address = row['Direccion'].strip()
        id_dir = int(row['id'])
        results = geocoder.geocode(address, no_annotations='1')
        if results and len(results):
            longitude = results[0]['geometry']['lng']
            latitude = results[0]['geometry']['lat']
            print(u'%i,%f;%f;%s' % (id_dir, latitude, longitude, address))


# query = ubicacion
# results = geocoder.geocode(query)

# print(results[0]['geometry']['lat'],
#       results[0]['geometry']['lng'])
