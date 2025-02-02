<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT f.family_id, f.family_name, a.house_number, r.first_name, r.last_name, a.street
        FROM family f
        JOIN address a ON a.address_id = f.address_id
        JOIN resident r ON r.resident_id = f.family_head_id
        WHERE f.family_name LIKE '%$search%' OR a.house_number LIKE '%$search%'
        OR r.first_name LIKE '%$search%' OR r.last_name LIKE '%$search%'
        OR a.street LIKE '%$search%'
        ORDER BY f.family_name ASC";
$result = $conn->query($sql);

$counter = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $counter++;

        $to_string = "<tr>
                        <td>" . $counter . "</td>
                        <td>" . $row['family_name'] . "</td>
                        <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
                        <td>" . $row['house_number'] . "</td>
                        <td>" . $row['street'] . "</td>
                        <td>
                            <div class='actions'>
                                <a href='view_family.php?id=" . $row['family_id'] . "' class='view-link'>
                                    <div class='bx-action'>
                                        <i class='bx bx-show' ></i>
                                        <p>View</p>
                                    </div>
                                </a>
                                <a href='delete_family.php?id=" . $row['family_id'] . "' class='delete-link'>
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
    echo "<tr><td colspan='4'>No families found.</td></tr>";
}
