<?php

function loadHouseDetails($conn, $address_id)
{
    $sql = "SELECT f.family_id, f.family_name, a.house_number, r.first_name, r.middle_name, r.last_name, a.street
            FROM family f
            JOIN address a ON a.address_id = f.address_id
            JOIN resident r ON r.family_id = f.family_id
            JOIN family_head fh ON fh.resident_id = r.resident_id
            WHERE a.address_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $address_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $counter = 0;
    $output = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $counter++;

            $output .= "<tr>
                            <td>" . $counter . "</td>
                            <td>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</td>
                            <td>" . $row['family_name'] . "</td>
                            <td>
                                <div class='actions'>
                                    <a href='../families-page/view_family.php?id=" . $row['family_id'] . "' class='view-link'>
                                        <div class='bx-action'>
                                            <i class='bx bx-show' ></i>
                                            <p>View</p>
                                        </div>
                                    </a>
                                    <a href='../families-page/delete_family.php?id=" . $row['family_id'] . "' class='delete-link'>
                                        <div class='bx-action'>
                                            <i class='bx bx-trash' ></i>
                                            <p>Delete</p>
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>";
        }
        return $output;
    } else {
        return "<tr><td colspan='4'>No families found.</td></tr>";
    }
}
