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
			    "num_pedido"  =>  $body["num_pedido"],
			    "id_cliente" => $body["id_cliente"],
			    "nome_recebedor" =>  $body["nome_recebedor"],
                "cpf_recebedor" =>  $body["cpf_recebedor"],
                "data_hora_entrega" =>  $body["data_hora_entrega"]
		    );
            if ((isset($novaEntrega["nome_recebedor"]) && $novaEntrega["nome_recebedor"] != NULL)
            && (isset($novaEntrega["cpf_recebedor"]) && $novaEntrega["cpf_recebedor"] != NULL)
            && (isset($novaEntrega["data_hora_entrega"]) && $novaEntrega["data_hora_entrega"] != NULL))  {
                return $response->withStatus(400)->write("Verifique o preenchimento dos campos");
            } else {
                $result = $entrega->update($entrega);
                return $result;
            }

        });

        $app->delete('/provlog/entrega/{id}', function(Request $request, Response $response) {
            $id = $request->getAttribute('id');
		    $entrega = $this->db->entregas[$id];
            $entrega->delete();
        });
$app->run();
?>