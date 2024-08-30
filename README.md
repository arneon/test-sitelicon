## Project description: 
Desarrollo de proyecto con varios paquetes laravel aplicando arquitectura hexagonal y DDD

## Developed packages:

- laravel-users: Paquete desarrollado para registrar datos de nuevos usuarios, para hacer login y crear nuevos usuarios. Tiene tests implementados
- laravel-orders: Paquete donde se registran nuevos pedidos (Solo cabecera), y se muestran los pedidos pendientes de pago por usuario logueado
- laravel-paypal-checkout: Paquete que simila el pago a través de una conexión sandbox

## Environment variables: 
SERVER_FQDN="http://localhost"
PAYPAL_MODE=sandbox
PAYPAL_CLIENT_ID="client_id generado en paypal"
PAYPAL_SECRET="secret generado en paypal"

## Steps to follow:
