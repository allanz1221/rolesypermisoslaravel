import csv
import requests

# URL de la API de Laravel para crear usuarios
url = 'https://tu-dominio.com/api/users'  # Asegúrate de que esta URL sea la correcta.

# Archivo CSV que contiene los datos de los usuarios
csv_file = 'usuarios.csv'

# Cabeceras para la solicitud POST
headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
}

# Leer el archivo CSV y enviar solicitudes para crear usuarios
with open(csv_file, newline='', encoding='utf-8') as file:
    reader = csv.DictReader(file)
    
    for row in reader:
        data = {
            'name': row['name'],
            'expediente': row['expediente'],
            'password': row['password'],  # Asegúrate de que el backend encripte la contraseña
            'pe': row['pe'],
            'rol': row['rol']
        }
        
        # Enviar solicitud POST para crear el usuario
        response = requests.post(url, json=data, headers=headers)
        
        if response.status_code == 201:
            print(f"Usuario {row['name']} creado exitosamente.")
        else:
            print(f"Error al crear usuario {row['name']}: {response.status_code} - {response.text}")

