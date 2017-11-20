<?php
require_once "./vendor/autoload.php";
use PHPMPDClient\MPD AS mpd;

mpd::connect("", "localhost");

?>

<?php
$songPos = $_POST["songPos"];

if(isset($_POST["remove"])){
    if(!isset($_POST['songPos'])){
        header('Location: /RadioUI/index.php');
    }
    removeSong($songPos);
}elseif(isset($_POST["setNext"])){
    if(!isset($_POST['songPos'])){
        header('Location: /RadioUI/index.php');
    }
    swapSong($songPos);
}elseif(isset($_POST["clear"])){
    mpd::clear();
}elseif(isset($_POST["pause"])){
    mpd::send("pause");
}elseif(isset($_POST["play"])){
    mpd::send("play");
}elseif(isset($_POST["next"])){
    mpd::send("next");
}


header('Location: /RadioUI/index.php');
?>







<?php 
function removeSong($toRemove){
    mpd::send("delete", $toRemove);
}

function swapSong($curPos){
    mpd::send("swap", 1, $curPos);
}

?>
