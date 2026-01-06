<?php
require "db.php";
// Optional: add your session/login check here
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Feeder Portal</title>
<style>
body { font-family: Arial; max-width: 600px; margin: 40px auto; }
h1 { text-align: center; }
button { padding: 10px 20px; margin: 10px; font-size: 16px; }
ul { list-style: none; padding: 0; }
li { margin: 5px 0; }
</style>
</head>
<body>
<h1>Feeder Portal</h1>

<!-- Manual Buttons -->
<form method="POST" action="send_command.php">
    <input type="hidden" name="device_id" value="feeder01">
    <button type="submit" name="command" value="FEED">FEED</button>
    <button type="submit" name="command" value="SLEEP">SLEEP</button>
</form>

<h2>Recent Commands</h2>
<?php
$stmt = $db->prepare("SELECT * FROM feeder_commands ORDER BY created_at DESC LIMIT 10");
$stmt->execute();
$commands = $stmt->fetchAll();

echo "<ul>";
foreach ($commands as $cmd) {
    $status = $cmd['executed'] ? "Executed" : "Pending";
    echo "<li>{$cmd['created_at']} — {$cmd['device_id']} — {$cmd['command']} — {$status}</li>";
}
echo "</ul>";
?>
</body>
</html>
