<?php
header("Content-Type: application/json");
require "../db.php"; // adjust path as needed

$device = $_GET['device_id'] ?? '';
$key    = $_GET['key'] ?? '';

if ($key !== "SECRET123") {
    http_response_code(403);
    echo json_encode(["command"=>"NONE"]);
    exit;
}

$stmt = $db->prepare("
  SELECT id, command
  FROM feeder_commands
  WHERE device_id=? AND executed=0
  ORDER BY id ASC
  LIMIT 1
");
$stmt->execute([$device]);
$row = $stmt->fetch();

if ($row) {
    $db->prepare("UPDATE feeder_commands SET executed=1 WHERE id=?")
       ->execute([$row['id']]);
    echo json_encode(["command"=>$row['command']]);
} else {
    echo json_encode(["command"=>"NONE"]);
}
