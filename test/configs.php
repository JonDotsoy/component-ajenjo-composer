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

echo "\n";
echo "Check folder config : ". ((file_exists(__DIR__.'/../app/config/'))? 'OK':'NO');
echo "\n";
echo "Check file config \"ajenjo.php\": ". ((file_exists(__DIR__.'/../app/config/ajenjo.php'))? 'OK':'NO');
echo "\n";
echo "Check config values: ".$config->get('ajenjo.path_consult');
echo "\n";
