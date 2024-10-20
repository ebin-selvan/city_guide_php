<?php

require_once __DIR__ . '/vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

$api_host = "http://127.0.0.1:8000";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/admin') {
  header('Location: '.$api_host.'/admin');
  exit();
}


switch (true) {
  case $uri === '/':
    echo $twig->render('pages/index.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/login':
    echo $twig->render('pages/login.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/register':
    echo $twig->render('pages/signup.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/about':
    echo $twig->render('pages/about.twig', ['api_host' => $api_host]);
    break;
   case $uri === '/cities':
    echo $twig->render('pages/cities.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/feedback':
    echo $twig->render('pages/feedback.twig', ['api_host' => $api_host]);
    break;
  case preg_match('/^\/category\/(\d+)$/', $uri, $matches) === 1:
    $categoryId = $matches[1];
    echo $twig->render('pages/category.twig', ['api_host' => $api_host, 'categoryId' => $categoryId]);
    break;
  case preg_match('/^\/attractions\/(\d+)$/', $uri, $matches) === 1:
    $attractionId = $matches[1];
    echo $twig->render('pages/attraction.twig', ['api_host' => $api_host, 'attractionId' => $attractionId]);
    break;
  case preg_match('/^\/city\/(\d+)$/', $uri, $matches) === 1:
    $cityId = $matches[1];
    echo $twig->render('pages/city.twig', ['api_host' => $api_host, 'cityId' => $cityId]);
    break;
  default:
    http_response_code(404);
    echo "Page Not Found";
    exit();
}
