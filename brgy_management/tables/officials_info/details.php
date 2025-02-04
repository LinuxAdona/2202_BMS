<?php
function getOfficialsDetails($conn, $officials_id)
{
    $sql = "SELECT r.first_name, r.middle_name, r.last_name, r.gender, r.contact_number, a.house_number, a.street, r.family_id, r.date_of_birth, o.position
            FROM officials o
            JOIN resident r ON o.resident_id = r.resident_id
            JOIN family f ON f.family_id = r.family_id
            JOIN address a ON f.address_id = a.address_id
            WHERE o.officials_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $officials_id);
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

function getGender($conn, $officials_id)
{
    if ($officials_id <= 0) return 'N/A';

    $sql = "SELECT r.gender 
            FROM officials o
            JOIN resident r ON r.resident_id = o.resident_id
            WHERE officials_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $officials_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $officials = $result->fetch_assoc();

        if ($officials['gender'] == 'Male') {
            return "<i class='bx bx-male' style='color: blue;'></i>";
        } else {
            return "<i class='bx bx-female' style='color: palevioletred;'></i>";
        }
    }

    return "N/A";
}
