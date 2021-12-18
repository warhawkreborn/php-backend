<?php
namespace Controllers;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AppController
{
   protected $container;
   
   // constructor receives container instance
   public function __construct(ContainerInterface $container) {
       $this->container = $container;
   }

   public function versionInfo(Request $request, Response $response, array $args) {
	//file_put_contents("test.json", json_encode($request->getHeaders()));
        $response = $response->withStatus(200)->withJson(json_decode(file_get_contents("../../app-version.json"), true));
        return $response;
   }

   public function getNews(Request $request, Response $response, array $args) {
	return $response->withRedirect('/news.html', 301);
   }
}
