## Project description: 
Desarrollo de proyecto con varios paquetes laravel aplicando arquitectura hexagonal y DDD

## Developed packages:

- laravel-users: Paquete desarrollado para registrar datos de nuevos usuarios, para hacer login y crear nuevos usuarios. Tiene tests implementados
- laravel-orders: Paquete donde se registran nuevos pedidos (Solo cabecera), y se muestran los pedidos pendientes de pago por usuario logueado
- laravel-paypal-checkout: Paquete que simula el pago a través de una conexión sandbox

## Environment variables: 
SERVER_FQDN="http://localhost"  
PAYPAL_MODE=sandbox  
PAYPAL_CLIENT_ID="client_id generado en paypal"  
PAYPAL_SECRET="secret generado en paypal"  

## Steps to configure project:
Ejecutar los siguientes comandos desde la consola:  
1.- composer install  
2.- cp .env.example .env  
3.- php artisan sail:install  
4.- sail up  
5.- sail artisan key:generate  
6.- sail artisan migrate  

Ejecutar los siguientes endpoints desde el archivo postman:
1.-   user-register (Puede cambiar los valores de los campos)  
1.1.- Copiar el valor del token generado en la variable postman "valid_token"  
2.-   create-order (puede cambiar los valores de los campos)  

Desde un navegador, abrir el siguiente enlace:  
http://localhost/api/users/login (Colocar email y password del usuario registrado vía postman)  
Luego será presentada una vista con el pedido registrado via postman en el que debe hacer click para efectuar el pago via paypal  

En la carpeta /tests/Feature está la colección postman para ejecutar los scripts
