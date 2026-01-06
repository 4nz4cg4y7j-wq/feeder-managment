<?php
require "db.php";

$now = date("H:i"); // server time HH:MM

$stmt = $db->prepare("SELECT device_id FROM feeder_schedule WHERE feed_time=? AND active=1");
$stmt->execute([$now]);
$schedules = $stmt->fetchAll();

foreach ($schedules as $s) {
    $stmt2 = $db->prepare("INSERT INTO feeder_commands (device_id, command) VALUES (?, 'FEED')");
    $stmt2->execute([$s['device_id']]);
}
