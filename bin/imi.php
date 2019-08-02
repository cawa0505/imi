<?php
if(!class_exists('Imi\App'))
{
    $fileName = dirname(__DIR__) . '/vendor/autoload.php';
    if(!is_file($fileName))
    {
        echo 'No file vendor/autoload.php', PHP_EOL;
        exit;
    }
    require $fileName;
    unset($fileName);
}

use Imi\App;
use Imi\Util\Args;
use Imi\Util\File;

Args::init(2);

$namespace = Args::get('appNamespace');
if(null === $namespace)
{
    $config = include File::path(dirname($_SERVER['SCRIPT_NAME'], 2), 'config/config.php');
    if(!isset($config['namespace']))
    {
        echo 'Has no namespace, please add arg: -appNamespace "Your App Namespace"', PHP_EOL;
        exit;
    }
    $namespace = $config['namespace'];
    unset($config);
}

App::run($namespace);
