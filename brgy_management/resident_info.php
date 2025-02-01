<?php
$resident_id = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = "SELECT r.first_name, r.middle_name, r.last_name, r.gender, a.house_number, a.street, r.family_id, r.date_of_birth
                        FROM resident r
                        JOIN address a ON r.address_id = a.address_id
                        WHERE r.resident_id = $resident_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $resident = $result->fetch_assoc();
    echo $resident['first_name'] . " " . substr($resident['middle_name'], 0, 1) . ". " . $resident['last_name'];
} else {
    echo "Resident not found.";
}
