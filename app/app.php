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

    //clear database of all stylists
    $app->post('/delete_stylists', function() use($app) {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists'=>Stylist::getAll()));
    });

    //brings user to specific stylist page
    $app->get("/stylists/{id}", function($id) use($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
    });

    //creates new clients and displays them on the same page
    $app->post('/clients', function() use($app) {
        //takes the input values and builds a new client and saves client to database
        $client_name = $_POST['client_name'];
        $phone = $_POST['phone'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($client_name, $phone, $stylist_id);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylists.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
    });

    //brings user to a page that allows a specific client to be edited
    $app->get('/client/{client_id}/edit', function($client_id) use ($app){
        $client = Client::find($client_id);
        return $app['twig']->render('client_edit.html.twig', array('clients'=>$client));
    });

    //posts edited data to the database to update a property in the existing restaurant
    $app->patch('/client/{client_id}', function($client_id) use ($app){
        $client = Client::find($client_id);
        $stylist = Stylist::find($_POST['stylist_id']);
        var_dump($_POST);
        foreach ($_POST as $key => $value) {
            if (!empty ($value)) {
                $client->update($key, $value);
            }
        }
        return $app['twig']->render('stylists.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
    });


    return $app;


?>
