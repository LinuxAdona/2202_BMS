<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

$totalHousesQuery = "SELECT COUNT(*) as count FROM address a
                     JOIN barangay b ON a.barangay_id = b.barangay_id
                     WHERE a.street LIKE '%$search%' OR b.barangay_name LIKE '%$search%'";
$totalHousesResult = $conn->query($totalHousesQuery);
$totalHouses = $totalHousesResult->fetch_assoc()['count'];
$totalPages = ceil($totalHouses / $limit);

$sql = "SELECT a.house_number, a.street, b.barangay_name, a.address_id
        FROM address a
        JOIN barangay b ON a.barangay_id = b.barangay_id
        WHERE a.street LIKE '%$search%' OR b.barangay_name LIKE '%$search%'
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
$counter = $offset + 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $familyCountSql = "SELECT COUNT(f.family_id) as family_count FROM family f WHERE f.address_id = " . $row['address_id'];
        $familyCountResult = $conn->query($familyCountSql);
        $familyCount = $familyCountResult->fetch_assoc()['family_count'];

        $to_string = "<tr>
                        <td>" . $counter++ . "</td>
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
                                <form action='delete_house.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row['address_id'] . "'>
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
        echo $to_string;
    }
} else {
    echo "<tr><td colspan='5'>No Houses found.</td></tr>";
}

echo "</tbody></table>";

if ($page <= 1) {
    echo "";
} else {
    echo "<div class='pagination'>";
    if ($page > 1) {
        echo "<a href='?page=" . ($page - 1) . "&search=" . urlencode($search) . "'><i class='bx bx-left-arrow-alt' ></i><p>Prev</p></a>";
    }
    echo " Page " . $page . " of " . $totalPages . " ";
    if ($page < $totalPages) {
        echo "<a href='?page=" . ($page + 1) . "&search=" . urlencode($search) . "'><p>Next</p><i class='bx bx-right-arrow-alt'></i></a>";
    }
    echo "</div>";
}
