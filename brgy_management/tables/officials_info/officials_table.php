<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT r.first_name, r.middle_name, r.last_name, o.position, o.officials_id
        FROM officials o
        JOIN resident r ON o.resident_id = r.resident_id
        WHERE r.first_name LIKE '%$search%' OR r.middle_name LIKE '%$search%'
        OR r.last_name LIKE '%$search%' OR o.position LIKE '%$search%'";
$result = $conn->query($sql);

$counter = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $counter++;

        $to_string = "<tr>
                        <td>" . $counter . "</td>
                        <td>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</td>
                        <td>" . $row['position'] . "</td>
                        <td>
                            <div class='actions'>
                                <a href='view_officials.php?id=" . $row['officials_id'] . "' class='view-link'>
                                    <div class='bx-action'>
                                        <i class='bx bx-show' ></i>
                                        <p>View</p>
                                    </div>
                                </a>
                                <a href='delete_officials.php?id=" . $row['officials_id'] . "' class='delete-link'>
                                    <div class='bx-action'>
                                        <i class='bx bx-trash' ></i>
                                        <p>Delete</p>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>";
        echo $to_string;
    }
} else {
    echo "<tr><td colspan='4'>No Officials found.</td></tr>";
}
