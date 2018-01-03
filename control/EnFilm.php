<?php
/**
 * Created by PhpStorm.
 * User: Tas
 * Date: 03-01-2018
 * Time: 13:45
 */


require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../view');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('EnFilm.html.twig');

$id = $_REQUEST['ID'];

$uri = "http://billetnatascha.azurewebsites.net/Service1.svc/movie/".$id;
$json = file_get_contents($uri);
$Mov = json_decode($json);

$twigContent = array("Movie" => $Mov); // fill in the content for the page
echo $template->render($twigContent);



