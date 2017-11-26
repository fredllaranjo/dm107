# Documentation

Documentation for ProvedorLogistica a logistics provider that handles the deliveries CRUD.

## DEFAULT USER
All requests requires Basic authentication (Authorization Header with encoded credential pair)
| USER | PASSWORD |
| ------ | ------ |
| fred | fred |


## API

### Java

CREATE a delivery
| DEFINITION | VALUE |
| ------ | ------ |
|_URL:_|/provlog/entrega/|
|_Method:_| POST|
|_Consumes(Media-Type):_|application/json|
|_Produces(Media-Type):_|application/json|
|_Request-Body(Payload):_|
{
    "numPedido" : "12345"; _*_
    "idCliente" : "966"; _*_
    "nomeRecebedor" : null;
    "cpfRecebedor" : null;
    "dataHoraEntrega" : null;
}

RETRIEVE a delivery
| DEFINITION | VALUE |
| ------ | ------ | 
|_URL:_|/provlog/entrega/{numPedido}|
|_Method:_| GET|
|_Produces(Media-Type):_|application/json|
|_PathParams:_| {numPedido} - the order number|

### PHP

UPDATE a delivery

DELETE a delivery



MARKDOWN (.md) guide: https://dillinger.io/