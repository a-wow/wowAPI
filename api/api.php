<?php
header('Content-Type: application/json');
include 'config.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'getCharacter':
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            getCharacterInfo($name, $pdo);
        } else {
            echo json_encode(["error" => "Character name not provided."]);
        }
        break;

    case 'getGuild':
        if (isset($_GET['guildName'])) {
            $guildName = $_GET['guildName'];
            getGuildInfo($guildName, $pdo);
        } else {
            echo json_encode(["error" => "Guild name not provided."]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid action."]);
        break;
}

function getCharacterInfo($name, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM characters WHERE name = :name");
    $stmt->execute(['name' => $name]);
    $character = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($character) {
        echo json_encode($character);
    } else {
        echo json_encode(["error" => "Character not found."]);
    }
}

function getGuildInfo($guildName, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM guild WHERE name = :guildName");
    $stmt->execute(['guildName' => $guildName]);
    $guild = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($guild) {
        $stmt = $pdo->prepare("SELECT * FROM guild_member WHERE guildid = :guildId");
        $stmt->execute(['guildId' => $guild['guildid']]);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'guild' => $guild,
            'members' => $members
        ]);
    } else {
        echo json_encode(["error" => "Guild not found."]);
    }
}
?>
