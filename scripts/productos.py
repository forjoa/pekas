import pymysql
import base64
from jinja2 import Template

# Datos de conexión a la base de datos
host = "localhost"
user = "root"
password = "1234"
database = "pekasProductos"

# Crear conexión a la base de datos
conn = pymysql.connect(host=host, user=user, password=password, database=database)

# Consultar los productos en la base de datos
cursor = conn.cursor()
cursor.execute("SELECT * FROM productos")
resultados = cursor.fetchall()

# Crear objeto Template de Jinja2
template = Template(open("tienda.html").read())

# Transformar los resultados de la consulta a una lista de diccionarios
productos = []
for resultado in resultados:
    producto = {
        "id": resultado[0],
        "nombre": resultado[1],
        "descripcion": resultado[2],
        "tipo": resultado[3],
        "precio": resultado[4],
        "imagen": resultado[6]
    }

    productos.append(producto)

# Renderizar la plantilla con los datos
html = template.render(productos=productos)

# Cerrar la conexión a la base de datos
conn.close()

# Escribir el HTML generado en un archivo
with open("tienda.html", "w") as f:
    f.write(html)
