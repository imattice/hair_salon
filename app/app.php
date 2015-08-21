<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    //allows use of delete and update functions
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    //landing page which displays all stylists
    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    //creates a new stylist, saves it to the database, and displays it on the homepage
    $app->post('/stylists', function() use($app) {
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    return $app;


?>
