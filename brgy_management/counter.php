<?php
include 'db.php';

$residentsCount = $conn->query("SELECT COUNT(*) as count FROM resident")->fetch_assoc()['count'];
$familyCount = $conn->query("SELECT COUNT(*) as count FROM family")->fetch_assoc()['count'];
$housesCount = $conn->query("SELECT COUNT(*) as count FROM address")->fetch_assoc()['count'];
$officialsCount = $conn->query("SELECT COUNT(*) as count FROM officials")->fetch_assoc()['count'];
