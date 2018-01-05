<?php
/**
 * Created by PhpStorm.
 * User: Tas
 * Date: 03-01-2018
 * Time: 13:35
 */

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

//$loader er en variable med navnet "loader"
$loader = new Twig_Loader_Filesystem('../view');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('alleFilm.html.twig');

$uri = "http://billetnatascha.azurewebsites.net/Service1.svc/movies";
$json = file_get_contents($uri);
$Liste = json_decode($json);

$twigContent = array ("Film" => $Liste); // fill in the content for the page
#print_r($twigContent);
echo $template->render($twigContent);

