<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\FormServiceProvider;
require_once __DIR__ . '/../config/config.db';
//DOCTRINE
use \Doctrine\Common\Cache\ApcCache;
use \Doctrine\Common\Cache\ArrayCache;
use BaseVideoArte\Controller\VideoArteController;
//use BaseVideoArte\Controller\VideoArteController;

$db = new Config();

$app = new Application();
$app -> register(new UrlGeneratorServiceProvider());
$app -> register(new ValidatorServiceProvider());
$app -> register(new ServiceControllerServiceProvider());

// Form
$app->register(new FormServiceProvider());
// translator
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
      'locale' => 'es',
      'translation.class_path' =>  __DIR__ . '/../vendor/symfony/src',
      'translator.messages' => array()
)) ;




$app['videoarte.controller'] = $app -> share(function() {
	return new VideoArteController($app);
});

// Register Doctrine DBAL

$app -> register(new Silex\Provider\DoctrineServiceProvider(), array('db.options' => array('driver' => 'pdo_mysql', 'host' => $db -> getHost(), 'dbname' => $db -> getBD(), 'user' => $db -> getUsuario(), 'password' => $db -> getPass(), 'charset' => 'utf8', 'driverOptions' => array(1002 => 'SET NAMES utf8', ), ), ));

// Register Doctrine ORM
$app -> register(new Nutwerk\Provider\DoctrineORMServiceProvider(), array('db.orm.proxies_dir' => __DIR__ . '/../cache/doctrine/proxy', 'db.orm.proxies_namespace' => 'DoctrineProxy', 'db.orm.cache' => !$app['debug'] && extension_loaded('apc') ? new ApcCache() : new ArrayCache(), 'db.orm.auto_generate_proxies' => true, 'db.orm.entities' => array( array('type' => 'annotation', // entity definition
'path' => __DIR__ . '/BaseVideoArte/Entidades', // path to your entity classes

'namespace' => 'BaseVideoArte\Entidades', // your classes namespace
)), ));

// $app->register(new TwigServiceProvider(), array(
// 'twig.path'    => array(__DIR__.'/../src/views'),
// 'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
//
// ));

$app -> register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__ . '/../src/BaseVideoArte/Vistas', 'twig.class_path' => __DIR__ . '/../vendor/twig/lib', ));
$app['twig'] = $app -> share($app -> extend('twig', function($twig, $app) {
	// add custom globals, filters, tags, ...

	return $twig;
}));



$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {

	$twig->addFunction(  new \Twig_SimpleFunction("esServer", function ($path,$uri) {
  
     $y = $path;
     if(strpos($uri,'http://basevideoarte.com.ar/') !== false){
     	$y = '/web';
     }
    echo  $y;
})

 );
    return $twig;
}));

return $app;
