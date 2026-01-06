<?php
require "db.php";

$device = $_POST['device_id'] ?? '';
$time   = $_POST['feed_time'] ?? '';

if (!$device || !$time) die("Invalid input");

$stmt = $db->prepare("INSERT INTO feeder_schedule (device_id, feed_time) VALUES (?, ?)");
$stmt->execute([$device, $time]);

header("Location: schedule_portal.php");
