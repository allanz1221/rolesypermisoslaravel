import csv
import mysql.connector
from bcrypt import hashpw, gensalt
# Configuración de la conexión a la base de datos MySQL
db_config = {
    'user': 'root',  # Reemplaza con tu usuario de MySQL
    'password': 'Navojoa2019',  # Reemplaza con tu contraseña de MySQL
    'host': 'ciencias.wiki',  # Reemplaza con tu host de MySQL
    'database': 'labs2024',  # Reemplaza con el nombre de tu base de datos
}

# Conexión a la base de datos
connection = mysql.connector.connect(**db_config)
cursor = connection.cursor()

# Archivo CSV que contiene los datos de los usuarios
csv_file = 'usuarios.csv'

# Consulta SQL para insertar usuarios
insert_query = '''
    INSERT INTO users (name, expediente, password, pe, rol, email)
    VALUES (%s, %s, %s, %s, %s, %s)
'''

with open(csv_file, newline='', encoding='ISO-8859-1') as file:
    for line in file:
        # Eliminar comillas dobles y dividir por coma
        cleaned_line = line.strip().replace('"', '')
        columns = cleaned_line.split(',')
        
        # Generar el email concatenando el expediente con '@ues.mx'
        email = columns[1] + '@ues.mx'

        encrypted_password = hashpw(columns[2].encode('utf-8'), gensalt()).decode('utf-8')
        
        # Asumir que las columnas están en el orden correcto
        data = (
            columns[0],  # name
            columns[1],  # expediente
            encrypted_password,  # password
            columns[3],  # pe
            columns[4],   # rol
            email  # email
        )
        
        try:
            # Ejecutar la consulta SQL
            cursor.execute(insert_query, data)
            connection.commit()
            print(f"Usuario {data[0]} creado exitosamente.")
        except mysql.connector.Error as err:
            print(f"Error al crear usuario {data[0]}: {err}")
            connection.rollback()

# Cerrar la conexión
cursor.close()
connection.close()
