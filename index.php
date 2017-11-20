<link rel="stylesheet" href="style.css">

<?php
require_once "./vendor/autoload.php";
use PHPMPDClient\MPD AS mpd;

mpd::connect("", "localhost");
mpd::send("consume", "1");
?>

<body>

<div class="addQue">
<?php
$current = mpd::currentSong()["values"];

print("<h2>" . $current[5] . " " . $current[4] . "</h2>");
?>

<span class="playerButton">
<a onclick="window.open('/radio/', 'player', 'menubar=no,location=yes,resizable=yes,scrollbars=no,status=no, width=300, height=200');">Click here to open the web player</a>
</span>

<?php
$albums = mpd::send("list", "album")["values"];

print("<h4>" .  "Albums:" . "</h4)<br>");

?>

<form action="addAlbum.php" method="post">

<?php
foreach($albums as $album){
?>

<input type="Radio" name="album" value="<?php print($album); ?>"><?php print($album);?>   <br>

<?php
} 
?>

<br>
<input type="submit" value="Add to playlist">
</form>

<br>
</div>

<div class="currentQue">
<h3>Current Queue:</h3>


<form action="removeSong.php" method="post">
<?php
$playlist = mpd::send("playlistinfo")["values"];
$i= 0;
foreach($playlist as $song){

$song = explode("Title: ", $song)[1];
if($song != NULL ){

?>
<input type="Radio" name="songPos" value="<?php print($i); ?>"><?php print($song);?><br>

<?php
$i++;
}
}
?>
<br>
<input type="submit" name="remove"  value="Remove from Queue"> <br>
<input type="submit" name="setNext" value="Play Next"> 
<input type="submit" name="clear"   value="Clear Playlist"> <br> 
<input type="submit" name="pause"   value="Pause"> 
<input type="submit" name="play"    value="Play">  
<input type="submit" name="next"    value="Next"> <br>
</form>

</div>
</body>
