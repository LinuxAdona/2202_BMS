<?php
include "../brgy_management/db.php";

if (isset($_POST['id'])) {
    $resident_id = $_POST['id'];

    // JavaScript confirmation dialog
    echo '<script>
        if (!confirm("Are you sure you want to delete this resident?")) {
            window.location.href = "residents.php"; // Redirect if not confirmed
        }
    </script>';

    // Retrieve the family_id for the resident
    $resident_query = $conn->query("SELECT family_id FROM resident WHERE resident_id = '$resident_id'");
    $resident = $resident_query->fetch_assoc();

    if ($resident) {
        $family_id = $resident['family_id'];

        // Retrieve the relationship details based on the family_id
        $relationship_query = $conn->query("SELECT father_id, mother_id, child_id FROM relationships WHERE family_id = '$family_id'");
        $relationship = $relationship_query->fetch_assoc();

        if ($relationship) {
            $father_id = $relationship['father_id'];
            $mother_id = $relationship['mother_id'];
            $child_id = $relationship['child_id'];

            // Insert relationships into deleted_relationships table
            $conn->query("INSERT INTO deleted_relationships (family_id, father_id, mother_id, child_id) 
                          VALUES ('$family_id', '$father_id', '$mother_id', '$resident_id')");

            // Insert resident details into deleted_residents table
            $conn->query("INSERT INTO deleted_residents (resident_id, first_name, middle_name, last_name, gender, date_of_birth, contact_number, family_id) 
                          SELECT resident_id, first_name, middle_name, last_name, gender, date_of_birth, contact_number, family_id  
                          FROM resident 
                          WHERE resident_id = " . $resident_id);

            // Delete the resident from resident table
            $conn->query("DELETE FROM resident WHERE resident_id = " . $resident_id);

            echo "Resident deleted successfully.";
            header("Location: residents.php");
            exit();
        } else {
            echo "No relationship found for the family.";
        }
    } else {
        echo "No resident found.";
    }
} else {
    echo "No resident ID provided.";
}
