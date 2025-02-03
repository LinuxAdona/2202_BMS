<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT a.house_number, a.street, b.barangay_name, a.address_id
        FROM address a
        JOIN barangay b ON a.barangay_id = b.barangay_id
        WHERE a.street LIKE '%$search%' OR b.barangay_name LIKE '%$search%'";

$result = $conn->query($sql);

$counter = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $counter++;

        $familyCountSql = "SELECT COUNT(f.family_id) as family_count FROM family f WHERE f.address_id = " . $row['address_id'];
        $familyCountResult = $conn->query($familyCountSql);
        $familyCount = $familyCountResult->fetch_assoc()['family_count'];

        $to_string = "<tr>
                        <td>" . $counter . "</td>
                        <td>" . $row['house_number'] . "</td>
                        <td>" . $row['street'] . "</td>
                        <td>" . $familyCount . "</td>
                        <td>
                            <div class='actions'>
                                <a href='view_house.php?id=" . $row['address_id'] . "' class='view-link'>
                                    <div class='bx-action'>
                                        <i class='bx bx-show' ></i>
                                        <p>View</p>
                                    </div>
                                </a>
                                <a href='delete_house.php?id=" . $row['address_id'] . "' class='delete-link'>
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
    echo "<tr><td colspan='5'>No Houses found.</td></tr>";
}
