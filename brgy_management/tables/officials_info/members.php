<?php
function loadOfficialMembers($conn, $officials_id)
{
    $sql = "SELECT r.first_name, r.middle_name, r.last_name, r.resident_id, o.officials_id, o.position
            FROM officials o
            JOIN resident r ON r.resident_id = o.resident_id
            WHERE o.officials_id != ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $officials_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>
                        <td><a href='../officials-page/view_officials.php?id=" . $row['officials_id'] . "'>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</a></td>
                        <td>" . $row['position'] . "</td>
                    </tr>";
        }
    } else {
        $output .= "<tr><td colspan='2'>No Family Members found.</td></tr>";
    }

    return $output;
}
