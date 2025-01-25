<?php
include 'db.php';

$residentsCount = $conn->query("SELECT COUNT(*) as count FROM residents")->fetch_assoc()['count'];

$purokResult = $conn->query("SELECT * FROM purok");
$purokList = [];
while ($row = $purokResult->fetch_assoc()) {
    $purokList[] = $row;
}
