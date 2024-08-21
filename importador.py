import csv
import requests

# URL de la API de Laravel para crear usuarios
url = 'https://ciencias.wiki/labs/public/api/users'  # Asegúrate de que esta URL sea la correcta.

# Archivo CSV que contiene los datos de los usuarios
csv_file = 'usuarios.csv'

# Cabeceras para la solicitud POST
headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
}
with open(csv_file, newline='', encoding='ISO-8859-1') as file:
    for line in file:
        # Eliminar comillas dobles y dividir por coma
        cleaned_line = line.strip().replace('"', '')
        columns = cleaned_line.split(',')
        
        # Asumir que las columnas están en el orden correcto
        data = {
            'name': columns[0],
            'expediente': columns[1],
            'password': columns[2],
            'pe': columns[3],
            'rol': columns[4]
        }
        
        # Enviar solicitud POST para crear el usuario
        response = requests.post(url, json=data, headers=headers)
        
        if response.status_code == 201:
            print(f"Usuario {data['name']} creado exitosamente.")
        else:
            print(f"Error al crear usuario {data['name']}: {response.status_code} - {response.text}")