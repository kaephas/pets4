<?php

session_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require vendor/autoload file
require_once('vendor/autoload.php');

// validation functions
require_once('model/validation-functions.php');

//Create an instance of the Base class (instantiate Fat-Free)
$f3 = Base::instance();

$f3->set('DEBUG', 3);

//Define Fat-Free array
$f3->set('colors', array('pink', 'purple', 'magenta', 'lavender'));
$f3->set('accessories', array('collar', 'leash', 'bowl', 'toy', 'food'));


//Define a default route
$f3->route('GET /', function() {
//    $view = new Template();
//    echo $view-> render('views/home.html');
    echo "<h1>My Pets</h1>";
    echo '<a href="order">Order a Pet</a>';
});

//$f3->route('GET /@animal', function($f3, $params) {
//
//    $animal = $params['animal'];
//
//    switch($animal) {
//        case 'chicken':
//            echo 'Cluck!';
//            break;
//        case 'dog':
//            echo 'Woof!';
//            break;
//        case 'cat':
//            echo 'Meow!';
//            break;
//        case 'elephant':
//            echo 'Toot!';
//            break;
//        case 'fish':
//            echo 'Glub';
//            break;
//        case 'fox':
//            echo 'Rinadingding';
//            break;
//        default:
//            $f3->error(404);
//    }
//
//});

$f3->route("GET|POST /order", function($f3) {
    $_SESSION = array();
    if(!empty($_POST)) {
        $pet = $_POST['pet'];
        $qty = $_POST['qty'];

        $f3->set('pet', $pet);
        $f3->set('qty', $qty);

//        if(validColor("pink")) {
//            $f3->reroute('/order2');
//        }
    }
        if(validForm1()) {
            $_SESSION['pet'] = $pet;
            $_SESSION['qty'] = $qty;

            $f3->reroute('/order2');
        }
//    }

    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->route("GET|POST /order2", function($f3) {

    if(!empty($_POST)) {
        $color = $_POST['color'];
        $access = $_POST['access'];


        $f3->set('color', $color);
        $f3->set('access', $access);

        if(validForm2()) {
            $_SESSION['color'] = $color;
            $_SESSION['access'] = $access;

            $f3->reroute('/results');
        }
    }

//    if(isset($_POST['color'])) {
//        $color = $_POST['color'];
//        if(validColor($color)) {
//            $_SESSION['color'] = $color;
//            $f3->reroute('/results');
//        } else {
//            $f3->set("errors['color']", "Please choose a color");
//        }
//    }
    $view = new Template();
    echo $view->render('views/form2.html');
});

$f3->route("GET|POST /results", function() {
    $view = new Template();
    echo $view->render('views/results.html');
});

//Run Fat-free
$f3->run();