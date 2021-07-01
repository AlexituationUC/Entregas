from opencage.geocoder import OpenCageGeocode
import sys

ubicacion = sys.argv[1]

key = 'e0449567eaaf40c68c95e7238d390381'
geocoder = OpenCageGeocode(key)

query = ubicacion
results = geocoder.geocode(query)

print(results[0]['geometry']['lat'],
      results[0]['geometry']['lng'])
