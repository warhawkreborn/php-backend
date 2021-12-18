<?php
namespace Controllers;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ClientController
{
   protected $container;
   
   // constructor receives container instance
   public function __construct(ContainerInterface $container) {
       $this->container = $container;
   }

   public function getExternalIP(Request $request, Response $response, array $args) {
        $data = [
            "ip" => $_SERVER['REMOTE_ADDR']
        ];
        $response = $response->withStatus(200)->withJson($data);
        return $response;
   }
}