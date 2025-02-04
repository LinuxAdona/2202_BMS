<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

$totalFamiliesQuery = "SELECT COUNT(*) as count FROM family f
                        JOIN family_head fh ON fh.family_id = f.family_id
                        JOIN resident r ON r.resident_id = fh.resident_id
                        WHERE f.family_name LIKE '%$search%' OR r.first_name LIKE '%$search%' OR r.last_name LIKE '%$search%'";
$totalFamiliesResult = $conn->query($totalFamiliesQuery);
$totalFamilies = $totalFamiliesResult->fetch_assoc()['count'];
$totalPages = ceil($totalFamilies / $limit);

$sql = "SELECT f.family_id, f.family_name, r.first_name, r.middle_name, r.last_name
        FROM family f
        JOIN family_head fh ON fh.family_id = f.family_id
        JOIN resident r ON r.resident_id = fh.resident_id
        WHERE f.family_name LIKE '%$search%' OR r.first_name LIKE '%$search%' OR r.last_name LIKE '%$search%'
        ORDER BY r.first_name, r.last_name ASC
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
$counter = $offset + 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $to_string = "<tr>
                        <td>" . $counter++ . "</td>
                        <td>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</td>
                        <td>" . $row['family_name'] . "</td>
                        <td>
                            <div class='actions'>
                                <a href='view_family.php?id=" . $row['family_id'] . "' class='view-link'>
                                    <div class='bx-action'>
                                        <i class='bx bx-show' ></i>
                                        <p>View</p>
                                    </div>
                                </a>
                                <form action='delete_family.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row['family_id'] . "'>
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
    echo "<tr><td colspan='4'>No families found.</td></tr>";
}

echo "</tbody></table>";
echo "<div class='pagination'>";
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "&search=" . urlencode($search) . "'><i class='bx bx-left-arrow-alt' ></i><p>Prev</p></a>";
}
echo " Page " . $page . " of " . $totalPages . " ";
if ($page < $totalPages) {
    echo "<a href='?page=" . ($page + 1) . "&search=" . urlencode($search) . "'><p>Next</p><i class='bx bx-right-arrow-alt'></i></a>";
}
echo "</div>";
