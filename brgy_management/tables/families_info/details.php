<?php
function getFamilyDetails($conn, $family_id)
{
    $sql = "SELECT r.resident_id, r.first_name, r.middle_name, r.last_name, r.gender, r.contact_number, a.house_number, a.street, r.family_id, r.date_of_birth
            FROM family f
            JOIN family_head fh ON fh.family_id = f.family_id
            JOIN resident r ON r.resident_id = fh.resident_id
            JOIN address a ON a.address_id = f.address_id
            WHERE f.family_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $family_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
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

function getGender($conn, $family_id)
{
    if ($family_id <= 0) return 'N/A';

    $sql = "SELECT r.gender 
            FROM family f
            JOIN family_head fh ON fh.family_id = f.family_id
            JOIN resident r ON r.resident_id = fh.resident_id
            WHERE f.family_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $family_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $family_head = $result->fetch_assoc();

        if ($family_head['gender'] == 'Male') {
            return "<i class='bx bx-male' style='color: blue;'></i>";
        } else {
            return "<i class='bx bx-female' style='color: palevioletred;'></i>";
        }
    }

    return "N/A";
}
