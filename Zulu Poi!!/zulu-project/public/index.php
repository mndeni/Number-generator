<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\FormController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../src/templates');
$twig = new Environment($loader);

$uri = $_SERVER['REQUEST_URI'];

$controller = new FormController($twig);

if ($uri == '/submit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleSubmit($_POST);
} else {
    $controller->showForm();
}
