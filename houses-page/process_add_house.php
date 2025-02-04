<?php
include "../brgy_management/db.php";

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $families = isset($_POST['families']) ? $_POST['families'] : [];
    $no_families = isset($_POST['no_families']) ? true : false;

    $sql_address = "INSERT INTO address (house_number, street, barangay_id) VALUES ('$house_number', '$street', 1)";
    if ($conn->query($sql_address) === TRUE) {
        $address_id = $conn->insert_id;

        if (!$no_families) {
            foreach ($families as $family_id) {
                $sql_association = "UPDATE family SET address_id = ? WHERE family_id = ?";
                $stmt_association = $conn->prepare($sql_association);
                $stmt_association->bind_param("ii", $address_id, $family_id);
                $stmt_association->execute();
            }
            $response['status'] = 'success';
            $response['message'] = 'Family and head of family added successfully.';
        } else {
            $response['status'] = 'success';
            $response['message'] = "House added successfully without associated families.";
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error: " . $sql_address . "<br>" . $conn->error;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($response);
