<?php
function getResidentDetails($conn, $resident_id)
{
    $sql = "SELECT r.first_name, r.middle_name, r.last_name, r.gender, r.contact_number, r.family_id, r.date_of_birth
            FROM resident r
            JOIN family f ON r.family_id = f.family_id
            WHERE r.resident_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resident_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getAddress($conn, $resident_id)
{
    $sql = "SELECT a.house_number, a.street
                   FROM address a
                   JOIN family f ON f.address_id = a.address_id
                   JOIN resident r ON r.family_id = f.family_id
                   WHERE r.resident_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resident_id);
    $stmt->execute();
    if ($result = $stmt->get_result()) {
        return $result->fetch_assoc();
    } else {
        return 'N/A';
    }
}

function getFamilyName($conn, $family_id)
{
    if ($family_id <= 0) return 'N/A';

    $sql = "SELECT family_name FROM family WHERE family_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $family_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0 ? $result->fetch_assoc()['family_name'] : 'N/A';
}

function getFamilyHead($conn, $family_id)
{
    if ($family_id <= 0) return 'N/A';

    $sql = "SELECT r.first_name, r.middle_name, r.last_name
            FROM resident r
            JOIN family f ON r.family_id = f.family_id
            JOIN family_head h ON r.resident_id = h.resident_id
            WHERE f.family_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $family_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $head = $result->fetch_assoc();
        return $head['first_name'] . " " . substr($head['middle_name'], 0, 1) . ". " . $head['last_name'];
    }
    return 'N/A';
}

function getGender($conn, $resident_id)
{
    if ($resident_id <= 0) return 'N/A';

    $sql = "SELECT gender FROM resident WHERE resident_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resident_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resident = $result->fetch_assoc();

        if ($resident['gender'] == 'Male') {
            return "<i class='bx bx-male' style='color: blue;'></i>";
        } else {
            return "<i class='bx bx-female' style='color: palevioletred;'></i>";
        }
    }

    return "N/A";
}
