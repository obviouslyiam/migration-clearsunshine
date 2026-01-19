<?php
// Check MySQL connection and WordPress tables

$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT');
$user = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$database = getenv('MYSQLDATABASE');

echo "<h1>Database Connection Check</h1>";
echo "<p><strong>Host:</strong> $host:$port</p>";
echo "<p><strong>User:</strong> $user</p>";
echo "<p><strong>Database:</strong> $database</p>";

try {
    $mysqli = new mysqli($host, $user, $password, $database, $port);

    if ($mysqli->connect_error) {
        echo "<p style='color: red;'><strong>Connection Error:</strong> " . $mysqli->connect_error . "</p>";
        die();
    }

    echo "<p style='color: green;'><strong>Connection Successful!</strong></p>";

    // Check for WordPress tables
    $result = $mysqli->query("SHOW TABLES");
    echo "<h2>Database Tables:</h2><ul>";
    $table_count = 0;
    while ($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
        $table_count++;
    }
    echo "</ul>";
    echo "<p><strong>Total tables:</strong> $table_count</p>";

    // Check wp_options table
    $result = $mysqli->query("SELECT option_name, option_value FROM wp_options WHERE option_name IN ('siteurl', 'home') LIMIT 2");
    if ($result && $result->num_rows > 0) {
        echo "<h2>WordPress Site URLs:</h2><ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>" . $row['option_name'] . ":</strong> " . $row['option_value'] . "</li>";
        }
        echo "</ul>";
    }

    $mysqli->close();
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>Error:</strong> " . $e->getMessage() . "</p>";
}
?>
