<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoe_store';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/brands", function() use ($app){

        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });
    $app->get("/stores", function() use ($app){

        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });
    $app->post("/brands", function() use ($app){
        $new_brand = new Brand($_POST['brandname']);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });
    $app->post("/stores", function() use ($app){
        $new_store = new Store($_POST['storename']);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });


    return $app;
?>
