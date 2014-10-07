<?php

include '/'."../vendor/autoload.php";


//specify the environment to load
$environment = 'local';

//second argument to FileLoader constructor
//is the path to the config folder
$loader = new Illuminate\Config\FileLoader(
     new Illuminate\Filesystem\Filesystem,
    __DIR__.'/../app/config'
);

$config = new Illuminate\Config\Repository($loader, $environment);

use ajenjo\connect;

$ajenjo = new connect(
	$config->get('ajenjo.base_uri'),
	$config->get('ajenjo.path_consult')
);

// echo $ejenjo->generateToken();

// Genera un nuevo token
echo "== Generate New Token: ";
echo ($ajenjo->generateToken()) ? 'OK' : 'NO';
echo "\n";
echo 'Auth: ';
var_dump($ajenjo->auth);
echo 'Token: ';
var_dump($ajenjo->token);
echo "\n\n";

// Inicia una nueva sesion con cuenta Admin:1234
echo "== Login Account(Admin:1234): ";
echo ($ajenjo->login('admin','1234')) ? 'OK' : 'NO';
echo "\n";
echo "Auth: ";
var_dump($ajenjo->auth);
echo "User: ";
var_dump($ajenjo->user);
echo "\n\n";

// Chequea el estado de la sesión actual
echo "== Checks the Current Session: ";
echo ($ajenjo->check()) ? 'OK' : 'NO';
echo "\n";
echo "Auth: ";
var_dump($ajenjo->auth);
echo "\n\n";

// Cierra Sesión actual
echo "== Logout Account(Admin): ";
echo ($ajenjo->logout()) ? 'OK' : 'NO';
echo "\n";
echo "Auth: ";
var_dump($ajenjo->auth);
echo "\n\n";

