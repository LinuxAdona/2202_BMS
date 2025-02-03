<?php
function loadFamilyMembers($conn, $family_id)
{
    $sql = "SELECT r.first_name, r.middle_name, r.last_name, r.resident_id,
                   CASE 
                       WHEN rel.father_id = r.resident_id THEN 'Father'
                       WHEN rel.mother_id = r.resident_id THEN 'Mother'
                       WHEN rel.child_id = r.resident_id THEN 'Child'
                       ELSE 'Sibling'
                   END AS relationship
            FROM resident r
            JOIN relationships rel ON r.family_id = rel.family_id
            WHERE r.family_id = ? AND (rel.father_id = r.resident_id OR rel.mother_id = r.resident_id OR rel.child_id = r.resident_id)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $family_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>
                        <td><a href='../residents-page/view_resident.php?id=" . $row['resident_id'] . "'>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</a></td>
                        <td>" . $row['relationship'] . "</td>
                    </tr>";
        }
    } else {
        $output .= "<tr><td colspan='2'>No Family Members found.</td></tr>";
    }

    return $output;
}
