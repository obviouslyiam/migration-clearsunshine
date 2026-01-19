<?php
// Simple script to update WordPress domain in database
// Run once via https://clearsunshine-production.up.railway.app/update-domain.php

define('WP_USE_THEMES', false);
require('./wp-load.php');

global $wpdb;

$new_url = 'https://clearsunshine-production.up.railway.app';

// Update options table
$wpdb->update(
    $wpdb->options,
    array('option_value' => $new_url),
    array('option_name' => 'siteurl')
);

$wpdb->update(
    $wpdb->options,
    array('option_value' => $new_url),
    array('option_name' => 'home')
);

// Verify the update
$siteurl = get_option('siteurl');
$home = get_option('home');

echo "<h1>WordPress Domain Update</h1>";
echo "<p><strong>Site URL:</strong> $siteurl</p>";
echo "<p><strong>Home URL:</strong> $home</p>";

if ($siteurl == $new_url && $home == $new_url) {
    echo "<p style='color: green;'><strong>SUCCESS!</strong> Domain updated successfully.</p>";
    echo "<p>You can now access the site at: <a href='$new_url'>$new_url</a></p>";
} else {
    echo "<p style='color: red;'><strong>ERROR:</strong> Domain update failed.</p>";
}
?>
