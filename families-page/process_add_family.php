<?php
include "../brgy_management/db.php";

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $family_name = $_POST['family_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $address_id = isset($_POST['address_id']) && $_POST['address_id'] !== 'NULL' ? $_POST['address_id'] : null;

    $stmt_family = $conn->prepare("INSERT INTO family (family_name, address_id) VALUES (?, ?)");
    $stmt_family->bind_param("si", $family_name, $address_id);

    if ($stmt_family->execute()) {
        $family_id = $conn->insert_id;

        $stmt_resident = $conn->prepare("INSERT INTO resident (first_name, middle_name, last_name, gender, contact_number, date_of_birth, family_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_resident->bind_param("ssssssi", $first_name, $middle_name, $last_name, $gender, $contact_number, $date_of_birth, $family_id);

        if ($stmt_resident->execute()) {
            $resident_id = $conn->insert_id;

            $stmt_family_head = $conn->prepare("INSERT INTO family_head (resident_id, family_id) VALUES (?, ?)");
            $stmt_family_head->bind_param("ii", $resident_id, $family_id);

            if ($stmt_family_head->execute()) {
                if ($gender == 'Male') {
                    $stmt_relationship = $conn->prepare("INSERT INTO relationships (family_id, father_id, mother_id, child_id) VALUES (?, ?, NULL, NULL)");
                    $stmt_relationship->bind_param("ii", $family_id, $resident_id);
                    $stmt_relationship->execute();
                } else if ($gender == 'Female') {
                    $stmt_relationship = $conn->prepare("INSERT INTO relationships (family_id, father_id, mother_id, child_id) VALUES (?, NULL, ?, NULL)");
                    $stmt_relationship->bind_param("ii", $family_id, $resident_id);
                    $stmt_relationship->execute();
                }

                $response['status'] = 'success';
                $response['message'] = 'Family and head of family added successfully.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $stmt_resident->error;
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $stmt_family->error;
    }

    $stmt_family->close();
    $stmt_resident->close();
    $stmt_family_head->close();
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($response);
