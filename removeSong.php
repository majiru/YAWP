<?php
require_once "./vendor/autoload.php";
use PHPMPDClient\MPD AS mpd;

mpd::connect("", "localhost");

if(!isset($_POST['songPos'])){
    header('Location: /RadioUI/index.php');
}
?>

<?php
$songPos = $_POST["songPos"];

if(isset($_POST["remove"])){
    removeSong($songPos);
}elseif(isset($_POST["setNext"])){
    swapSong($songPos);
}elseif(isset($_POST["clear"])){
    mpd::clear();
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
