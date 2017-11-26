<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$config['displayErrorDetails'] = true; 
$config['addContentLengthHeader'] = false;
$config['db']['host'] = "localhost"; 
$config['db']['user'] = "root"; 
$config['db']['pass'] = "root"; 
$config['db']['dbname'] = "provlog";

$app = new \Slim\App(["config" => $config]);

$app->add(new Slim\Middleware\HttpBasicAuthentication([
    "path" => ["/api/"],
    "realm" => "Protected",
    "authenticator" => new Slim\Middleware\HttpBasicAuthentication\PdoAuthenticator([
        "pdo" => new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['dbname'], $config['db']['user'], $config['db']['pass']),
        "table" => "users",
        "user" => "username",
        "hash" => "password"
            ])
]));


$container = $app->getContainer();

$container['db'] = function ($c) 
{ 
        $dbConfig = $c['config']['db']; 
        $pdo = new PDO("mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['dbname'], $dbConfig['user'], $dbConfig['pass']); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        $db = new NotORM($pdo); 
        return $db; 
};

    $app->put('/provlog/entrega/{id}', function(Request $request, Response $response) {
            
            $id = $request->getAttribute("id");

		    $entrega = $this->db->entregas[$id];
            $body = $request->getParsedBody();
			    $novaEntrega = array(
			    "num_pedido"  =>  $body["numPedido"],
			    "id_cliente" => $body["idCliente"],
			    "nome_recebedor" =>  $body["nomeRecebedor"],
                "cpf_recebedor" =>  $body["cpfRecebedor"],
                "data_hora_entrega" =>  $body["dataHoraEntrega"]
		    );
            if ((isset($novaEntrega["nome_recebedor"]) && $novaEntrega["nome_recebedor"] != NULL)
            && (isset($novaEntrega["cpf_recebedor"]) && $novaEntrega["cpf_recebedor"] != NULL)
            && (isset($novaEntrega["data_hora_entrega"]) && $novaEntrega["data_hora_entrega"] != NULL))  {
                $result = $entrega->update($novaEntrega);
                return $result;
            } else {
                return $response->withStatus(400)->write("Verifique o preenchimento dos campos");
            }

        });

        $app->delete('/provlog/entrega/{id}', function(Request $request, Response $response) {
            $id = $request->getAttribute('id');
		    $entrega = $this->db->entregas[$id];
            $entrega->delete();
        });
$app->run();
?>