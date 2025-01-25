<?php
include 'db.php';

$residentsCount = $conn->query("SELECT COUNT(*) as count FROM resident")->fetch_assoc()['count'];
$housesCount = $conn->query("SELECT COUNT(*) as count FROM address")->fetch_assoc()['count'];
