<?php
require "db.php";

$device  = $_POST['device_id'] ?? '';
$command = $_POST['command'] ?? '';

if (!$device || !$command) {
    die("Invalid request");
}

$stmt = $db->prepare("INSERT INTO feeder_commands (device_id, command) VALUES (?, ?)");
$stmt->execute([$device, $command]);

header("Location: feeder_portal.php");
