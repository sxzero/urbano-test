# Ejercicios Urbano

## Deploy local con Docker
```console
docker build -t TAG .
```

Para utilizar docker compose se debe reemplazar la etiqueta **sxzero/urbano-test** en el archivo yml por la construida previamente.
```console
docker-compose up
```

## Variables de entorno
| Variable | Descripción |
|:----------|:-------------|
| DB_HOST | Servidor de base de datos |
| DB_PORT | Puerto |
| DB_DATABASE | Nombre de la base de datos |
| DB_USERNAME | Usuario |
| DB_PASSWORD | Contraseña |
| DB_PREFIX | Prefijo |
| XML_FOLDER | Carpeta publica para almacenar los XML |


## Entry Point
http://localhost:9100