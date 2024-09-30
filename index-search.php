<?php
$characterInfo = [];
$guildInfo = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['characterName'])) {
    $characterName = $_POST['characterName'];
    $guildName = $_POST['guildName'] ?? '';

    $characterInfo = getCharacter($characterName);
    
    if ($guildName) {
        $guildInfo = getGuild($guildName);
    }
}

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search for a character</title>
</head>
<body>

<h1>Search for a character</h1>
<form method="POST">
    <label for="characterName">Character name:</label>
    <input type="text" id="characterName" name="characterName" required>
    
   <label for="guildName">Guild name (optional):</label>
    <input type="text" id="guildName" name="guildName">
    
    <button type="submit">Search</button>
</form>

<h2>Character Information:</h2>
<pre><?php echo isset($characterInfo) ? print_r($characterInfo, true) : 'Information not found.'; ?></pre>

<h2>Guild information:</h2>
<pre><?php echo isset($guildInfo) ? print_r($guildInfo, true) : 'Information not found.'; ?></pre>

</body>
</html>
