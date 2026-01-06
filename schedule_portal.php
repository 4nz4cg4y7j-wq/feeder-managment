<?php
require "db.php"; 
// your login/session check here
?>

<h1>Feeder Schedule</h1>

<!-- Add new schedule -->
<form method="POST" action="add_schedule.php">
    Device ID: <input type="text" name="device_id" value="feeder01"><br>
    Feed Time (HH:MM 24h): <input type="time" name="feed_time"><br>
    <button type="submit">Add Schedule</button>
</form>

<h2>Current Schedule</h2>
<?php
$stmt = $db->prepare("SELECT * FROM feeder_schedule ORDER BY feed_time ASC");
$stmt->execute();
$schedules = $stmt->fetchAll();

echo "<ul>";
foreach ($schedules as $s) {
    $status = $s['active'] ? "Active" : "Inactive";
    echo "<li>{$s['device_id']} — {$s['feed_time']} — {$status}</li>";
}
echo "</ul>";
?>
