<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'dao/connection.php';
require 'dao/entregadao.php';
require 'dao/userdao.php';

$app = new \Slim\App;

$user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : NULL;
$pwd = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : NULL;


$userDao = new UserDao();
    
if ($userDao->userExists($user, $pwd)) {
    $app->add(new Tuupola\Middleware\HttpBasicAuthentication([
        "user" => [$user => $pwd]
		]));
    $app->put('/provlog/entrega', function(Request $request, Response $response) {
            $entregaDao = new EntregaDao();
            $entrega = $request->getParsedBody();

            if (!isValid($entrega)) {
                return $response->withStatus(400)->write("Verifique o preenchimento dos campos");
            } else {
                $result = $entregaDao->update($entrega);

                if ($result) {
                    return $response->withStatus(200);
                }

                return $response;
            }

        });

        $app->delete('/provlog/entrega/{id}', function(Request $request, Response $response) {
            $entregaDao = new EntregaDao();
            $entregaId = $request->getAttribute('id');

            $result = $entregaDao->delete($entregaId);

            if ($resullt) {
                return $response->withStatus(200);
            }

            return $response;
        });
	} else {
        $app->add(new Tuupola\Middleware\HttpBasicAuthentication([
            "user" => $userDao->getUsers(),
            "error" => function ($request, $response, $arguments) {
                $data = [];
                $data["status"] = "error";
                $data["message"] = $arguments["message"];

                return $response->write(json_encode($data, JSON_UNESCAPED_SLASHES), 401);
            }
		]));
    }

public function isValid($entrega){
    if ($this->isFieldDefined($entrega, "id")
        && $this->isFieldDefined($entrega, "nome_recebedor")
        && $this->isFieldDefined($entrega, "cpf_recebedor")
        && $this->isFieldDefined($entrega, "data_entrega"))  {
        return true;
    }

    return false;
}

private function isFieldDefined($entrega, $field) {
    return (isset($entrega[$field]) && $entrega[$field] != NULL);
}

$app->run();
?>