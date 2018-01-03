<?php
/**
 * Created by PhpStorm.
 * User: Tas
 * Date: 03-01-2018
 * Time: 13:35
 */

// set up twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../view');   // set folder to html/twig files
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('alleFIlm.html.twig'); // actual twig file

$vid = new stdClass();
$vid ->Titel = $_REQUEST['Titel'];
$vid ->Rating = $_REQUEST['Rating'];

$json = json_encode($vid);

// set up POST request
$URI = 'http://billetnatascha.azurewebsites.net/Service1.svc/movies';                      // URL to REST API
$req = curl_init($URI);                          // initlize curl
curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST"); // request method
curl_setopt($req, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json))          // insert header i.e mime-type + length
);
curl_setopt($req, CURLOPT_POSTFIELDS, $json);   // insert data in body
curl_setopt($req, CURLOPT_RETURNTRANSFER, true); // do not display json

$result = curl_exec($req); // sends the request and get result

$jsonStr = file_get_contents($URI);
$Liste = json_decode($jsonStr);



$twigContent = array("Film" => $Liste);                     // fill in the content for the page
echo $template->render($twigContent); // let twig file generate html

