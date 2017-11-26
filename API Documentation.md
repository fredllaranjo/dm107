# Documentation

Documentation for ProvedorLogistica a logistics provider that handles the deliveries CRUD.

## DEFAULT USER
All requests requires Basic authentication (Authorization Header with encoded credential pair)
| USER | PASSWORD |
| ------ | ------ |
| fred | fred |


## API

---  
---  
### Java

---  
CREATE a delivery
| DEFINITION | VALUE |
| ------ | ------ |
|_URL:_|http://localhost:8080/ProvedorLogisticaJava/provlog/entrega/|
|_Method:_| POST|
|_Consumes(Media-Type):_|application/json|
|_HTTP Status Codes:_|200 OK, 500 Unexpected Server Error, 400 BadRequest (* obrigatory fields not informed)|
|_Request-Body(Payload):_|  
{  
"numPedido" : 20000,_*_  
"idCliente" : 966,_*_  
"nomeRecebedor" : null,  
"cpfRecebedor" : null,  
"dataHoraEntrega" : null  
}  

---  
RETRIEVE a delivery
| DEFINITION | VALUE |
| ------ | ------ | 
|_URL:_| http://localhost:8080/ProvedorLogisticaJava/provlog/entrega/{numPedido}|
|_Method:_| GET|
|_Produces(Media-Type):_|application/json|
|_PathParams:_| {numPedido} - the order number|
|_HTTP Status Codes:_|200 OK, 500 Unexpected Server Error|
|_Response Body:_|
{  
"id" : 1,  
"numPedido" : 20000,  
"idCliente" : 966,  
"nomeRecebedor" : "Fred",  
"cpfRecebedor" : "111.222.333-44",  
"dataHoraEntrega" : "26/11/2017 16:28"  
}

---  
---  
### PHP

---  
UPDATE a delivery
| DEFINITION | VALUE |
| ------ | ------ | 
|_URL:_| http://localhost/ProvedorLogisticaPHP/src/public/provlog/entrega/{id} |  
|_Method:_| PUT|
|_Consumes(Media-Type):_|application/json|
|_PathParams:_| {id} - the delivery id|
|_HTTP Status Codes:_|200 OK, 500 Unexpected Server Error, 400 BadRequest (* obrigatory fields not informed)|
|_Request-Body(Payload):_|  
{  
"numPedido" : 20000,  
"idCliente" : 966,  
"nomeRecebedor" : "Fred",_*_  
"cpfRecebedor" : "111.222.333-44",_*_  
"dataHoraEntrega" : "26/11/2017 16:28"_*_  
}  

---  
DELETE a delivery  
| DEFINITION | VALUE |
| ------ | ------ | 
|_URL:_| http://localhost/ProvedorLogisticaPHP/src/public/provlog/entrega/{id} |  
|_Method:_| DELETE|
|_PathParams:_| {id} - the delivery id|
|_HTTP Status Codes:_|200 OK, 500 Unexpected Server Error|

---  
By Frederico A. Laranjo Silva  
MARKDOWN (.md) guide: https://dillinger.io/