<?php
include "../brgy_management/db.php";

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'] ?? null;
    $middle_name = $_POST['middle_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $contact_number = $_POST['contact_number'] ?? null;
    $date_of_birth = $_POST['date_of_birth'] ?? null;
    $family_id = $_POST['family_id'] ?? null;
    $relationship = $_POST['relationship'] ?? null;

    if (empty($first_name) || empty($last_name) || empty($gender) || empty($contact_number) || empty($date_of_birth) || empty($family_id) || $relationship === 'select') {
        $response['status'] = 'error';
        $response['message'] = 'All fields are required, and a valid relationship must be selected.';
        echo json_encode($response);
        exit;
    }

    $stmt_resident = $conn->prepare("INSERT INTO resident (first_name, middle_name, last_name, gender, contact_number, date_of_birth, family_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_resident->bind_param("ssssssi", $first_name, $middle_name, $last_name, $gender, $contact_number, $date_of_birth, $family_id);

    if ($stmt_resident->execute()) {
        $resident_id = $conn->insert_id;
        $mother_id = null;
        $child_id = null;

        if ($relationship === 'mother') {
            $mother_id = $resident_id;
        } else {
            $child_id = $resident_id;
        }

        $stmt_relationship = $conn->prepare(
            "INSERT INTO relationships (family_id, father_id, mother_id, child_id) VALUES (?, NULL, ?, ?)"
        );
        $stmt_relationship->bind_param("iii", $family_id, $mother_id, $child_id);

        if ($stmt_relationship->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Resident added successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error inserting relationship: ' . $stmt_relationship->error;
        }

        $stmt_relationship->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error inserting resident: ' . $stmt_resident->error;
    }

    $stmt_resident->close();
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($response);
