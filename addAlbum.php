<?php
require_once "./vendor/autoload.php";
use PHPMPDClient\MPD AS mpd;

mpd::connect("", "localhost");
?>

<?php


//Clears current playlist, useful for testing
//mpd::clear();


$album = explode("Album: ", $_POST["album"])[1];
$album = rtrim($album);
$result = mpd::send("search","Album", $album)["values"];

foreach($result as $song){
    $song = explode("file: ", $song)[1];
    $song = rtrim($song);
    if($song != NULL){
        mpd::add($song);
    }
}

mpd::send("play");
header('Location: /RadioUI/index.php');
?>

