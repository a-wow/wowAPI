<?php
$characterName = "Your_Character_Name"; // Please enter the character's name
$guildName = "Your_Guild_Name"; // Please enter the guild name

function getCharacter($name) {
    $url = "http://your_server/api.php?action=getCharacter&name=" . urlencode($name);
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function getGuild($name) {
    $url = "http://your_server/api.php?action=getGuild&guildName=" . urlencode($name);
    $response = file_get_contents($url);
    return json_decode($response, true);
}

$characterInfo = getCharacter($characterName);
$guildInfo = getGuild($guildName);

echo "<h1>Character Information:</h1>";
print_r($characterInfo);

echo "<h1>Guild Information:</h1>";
print_r($guildInfo);
