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
    $app->get("/brand/{id}", function($id) use ($app){
        $found_brand = Brand::find($id);

        return $app['twig']->render('brand.html.twig', array('brand' => $found_brand, 'stores' => $found_brand->getStore(), 'stores2' => $found_brand->notStore(), 'all_stores' => Store::getAll()));
    });
    $app->get("/store/{id}", function($id) use ($app){
        $found_store = Store::find($id);

        return $app['twig']->render('store.html.twig', array('store' => $found_store,  'brands' => $found_store->getBrand(), 'brands2' => $found_store->notBrand(),'all_stores' => Store::getAll()));
    });
    $app->post("/store/{id}", function($id) use ($app){
        $store = Store::find($id);
        $new_brand = Brand::find($_POST['brand_id']);
        $store->addBrand($new_brand);

        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrand(), 'brands2' => $store->notBrand(), 'all_brands' => Brand::getAll()));
    });
    $app->post("/brand/{id}", function($id) use ($app){
        $brand = Brand::find($id);
        $new_store = Store::find($_POST['store_id']);
        $brand->addStore($new_store);

        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStore(), 'stores2' => $brand->notStore(), 'all_stores' => Store::getAll()));
    });


    return $app;
?>
