<?php
include "../brgy_management/db.php";

if (isset($_POST['id'])) {
    $family_id = $_POST['id'];

    // JavaScript confirmation dialog
    echo '<script>
        if (!confirm("Are you sure you want to delete this family?")) {
            window.location.href = "families.php"; // Redirect if not confirmed
        }
    </script>';

    // Insert the family into deleted_families table
    $conn->query("INSERT INTO deleted_families (family_id, family_name, address_id) 
                  SELECT family_id, family_name, address_id FROM family WHERE family_id = " . $family_id);

    // Delete relationships associated with the family and log them
    $conn->query("INSERT INTO deleted_relationships (relationship_id, family_id, father_id, mother_id, child_id) 
                  SELECT relationship_id, family_id, father_id, mother_id, child_id 
                  FROM relationships WHERE family_id = " . $family_id);
    $conn->query("DELETE FROM relationships WHERE family_id = " . $family_id);

    // Delete family heads and log them
    $conn->query("INSERT INTO deleted_family_heads (family_head_id, family_id, resident_id) 
                  SELECT family_head_id, family_id, resident_id 
                  FROM family_head WHERE family_id = " . $family_id);
    $conn->query("DELETE FROM family_head WHERE family_id = " . $family_id);

    // Move family and its members to deleted_residents table
    $conn->query("INSERT INTO deleted_residents (resident_id, first_name, middle_name, last_name, gender, date_of_birth, contact_number, family_id) 
                  SELECT resident_id, first_name, middle_name, last_name, gender, date_of_birth, contact_number, family_id 
                  FROM resident WHERE family_id = " . $family_id);

    // Delete residents from resident table
    $conn->query("DELETE FROM resident WHERE family_id = " . $family_id);

    // Delete the family from family table
    $conn->query("DELETE FROM family WHERE family_id = " . $family_id);

    echo "Family deleted successfully.";
    header("Location: families.php");
    exit();
} else {
    echo "No family ID provided.";
}
