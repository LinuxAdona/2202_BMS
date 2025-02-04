<?php
include "../brgy_management/db.php";

if (isset($_POST['id'])) {
    $address_id = $_POST['id'];

    $familyCountQuery = "SELECT COUNT(*) as family_count FROM family WHERE address_id = ?";
    $stmt = $conn->prepare($familyCountQuery);
    $stmt->bind_param("i", $address_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $familyCount = $result->fetch_assoc()['family_count'];

    if ($familyCount > 0) {
        $conn->query("UPDATE family SET address_id = NULL WHERE address_id = " . $address_id);
    }

    $conn->query("INSERT INTO deleted_houses (address_id, house_number, street, barangay_id) SELECT address_id, house_number, street, barangay_id FROM address WHERE address_id = " . $address_id);
    $conn->query("DELETE FROM address WHERE address_id = " . $address_id);

    echo "House deleted successfully.";
    header("Location: houses.php");
    exit();
} else {
    echo "No house ID provided.";
}
