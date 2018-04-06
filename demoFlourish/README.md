# botanas

If using docker toolbox for Windows
Create text file ".env"
with contents:  

COMPOSE_CONVERT_WINDOWS_PATHS=1

## Initial Setup

1. Copiar el archivo `.botanas_env.default` a `.botanas_env`
2. Editarlo con las variables necesarias (las variables por defecto para mysql estan en `docker-compose.yaml`)
3. Copiar el archivo de dump necesario `<archivo_dump>.sql` en el directorio `db`
4. Iniciar los contenedores con el comando `docker-compose up -d` (si es muy pesado el archivo dump es mejor importarlo manualmente)
5. Esto levantará mysql, creará una carpeta un directorio superior al del repositorio llamado `db` con la base de datos
6. Fin, acceder a la URL local (localhost)[http://localhost:8080] (por defecto) y a (PHPMyAdmin Local)[http://localhost:9000] (defecto)

## Información de tablas

La tabla `store_inventory_movement` Referencia las siguientes tablas:

* DriverInventory
* TicketProductDescription
* StoreInventoryAdjustmentDescription
* TicketCargoDescription
* TicketCargoReturnDescription
* TicketStoreMovementProductDescription
