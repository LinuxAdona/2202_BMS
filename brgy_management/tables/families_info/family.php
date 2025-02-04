<?php
function loadFamilyMembers($conn, $family_id, $resident_id)
{
    $sql = "SELECT r.first_name, r.middle_name, r.last_name, r.resident_id, r.gender,
                   CASE 
                       WHEN rel.father_id = r.resident_id THEN 'Father'
                       WHEN rel.mother_id = r.resident_id THEN 'Mother'
                       WHEN rel.child_id = r.resident_id THEN 'Child'
                       ELSE 'Sibling'
                   END AS relationship
            FROM resident r
            JOIN relationships rel ON r.family_id = rel.family_id
            WHERE r.family_id = ? AND (rel.father_id = r.resident_id OR rel.mother_id = r.resident_id OR rel.child_id = r.resident_id)
            AND r.resident_id != ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $family_id, $resident_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $child = '';

            if (isChild($conn, $resident_id, $family_id)) {
                if ($row['relationship'] == 'Child') {
                    if ($row['gender'] == 'Female') {
                        $child = 'Sister';
                    } else {
                        $child = 'Brother';
                    }

                    $output .= "<tr>
                                <td><a href='../residents-page/view_resident.php?id=" . $row['resident_id'] . "'>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</a></td>
                                <td>" . $child . "</td>
                                <td>
                                    <div class='actions'>
                                        <form action='../residents-page/delete_resident.php' method='POST'>
                                            <input type='hidden' name='id' value='" . $row['resident_id'] . "'>
                                            <button type='submit' class='delete-link'>
                                                <div class='bx-action'>
                                                    <i class='bx bx-trash' ></i>
                                                    <p>Delete</p>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>";
                } else {
                    $output .= "<tr>
                                <td><a href='../residents-page/view_resident.php?id=" . $row['resident_id'] . "'>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</a></td>
                                <td>" . $row['relationship'] . "</td>
                                <td>
                                    <form action='../residents-page/delete_resident.php' method='POST'>
                                        <input type='hidden' name='id' value='" . $row['resident_id'] . "'>
                                        <button type='submit' class='delete-link'>
                                            <div class='bx-action'>
                                                <i class='bx bx-trash' ></i>
                                                <p>Delete</p>
                                            </div>
                                        </button>
                                    </form>
                                </td>
                            </tr>";
                }
            } else {
                if ($row['relationship'] == 'Child') {
                    if ($row['gender'] == 'Female') {
                        $child = 'Daughter';
                    } else {
                        $child = 'Son';
                    }

                    $output .= "<tr>
                                    <td><a href='../residents-page/view_resident.php?id=" . $row['resident_id'] . "'>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</a></td>
                                    <td>" . $child . "</td>
                                    <td>
                                        <form action='../residents-page/delete_resident.php' method='POST'>
                                            <input type='hidden' name='id' value='" . $row['resident_id'] . "'>
                                            <button type='submit' class='delete-link'>
                                                <div class='bx-action'>
                                                    <i class='bx bx-trash' ></i>
                                                    <p>Delete</p>
                                                </div>
                                            </button>
                                        </form>
                                    </td>
                                </tr>";
                } else {
                    $output .= "<tr>
                                    <td><a href='../residents-page/view_resident.php?id=" . $row['resident_id'] . "'>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</a></td>
                                    <td>" . $row['relationship'] . "</td>
                                    <td>
                                        <form action='../residents-page/delete_resident.php' method='POST'>
                                            <input type='hidden' name='id' value='" . $row['resident_id'] . "'>
                                            <button type='submit' class='delete-link'>
                                                <div class='bx-action'>
                                                    <i class='bx bx-trash' ></i>
                                                    <p>Delete</p>
                                                </div>
                                            </button>
                                        </form>
                                    </td>
                                </tr>";
                }
            }
        }
    } else {
        $output .= "<tr><td colspan='3'>No Family Members found.</td></tr>";
    }

    return $output;
}

function isChild($conn, $resident_id, $family_id)
{
    $sql = "SELECT r.resident_id, CASE 
                       WHEN rel.father_id = r.resident_id THEN 'Father'
                       WHEN rel.mother_id = r.resident_id THEN 'Mother'
                       WHEN rel.child_id = r.resident_id THEN 'Child'
                   END AS relationship
            FROM resident r
            JOIN relationships rel ON r.family_id = rel.family_id
            WHERE r.family_id = ? AND (rel.father_id = r.resident_id OR rel.mother_id = r.resident_id OR rel.child_id = r.resident_id)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $family_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = false;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['resident_id'] == $resident_id) {
                if ($row['relationship'] == 'Child') {
                    $output .= true;
                }
            }
        }
    }

    return $output;
}
