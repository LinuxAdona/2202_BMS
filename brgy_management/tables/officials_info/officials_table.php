<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

$totalOfficialsQuery = "SELECT COUNT(*) as count FROM officials o
                        JOIN resident r ON o.resident_id = r.resident_id
                        WHERE r.first_name LIKE '%$search%' OR r.middle_name LIKE '%$search%'
                        OR r.last_name LIKE '%$search%' OR o.position LIKE '%$search%'";
$totalOfficialsResult = $conn->query($totalOfficialsQuery);
$totalOfficials = $totalOfficialsResult->fetch_assoc()['count'];
$totalPages = ceil($totalOfficials / $limit);

$sql = "SELECT r.first_name, r.middle_name, r.last_name, o.position, o.officials_id
        FROM officials o
        JOIN resident r ON o.resident_id = r.resident_id
        WHERE r.first_name LIKE '%$search%' OR r.middle_name LIKE '%$search%'
        OR r.last_name LIKE '%$search%' OR o.position LIKE '%$search%'
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
$counter = $offset + 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $to_string = "<tr>
                        <td>" . $counter++ . "</td>
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
                            </div>
                        </td>
                    </tr>";
        echo $to_string;
    }
} else {
    echo "<tr><td colspan='4'>No Officials found.</td></tr>";
}

echo "</tbody></table>";

if ($page <= 1) {
    echo "";
} else {
    echo "<div class='pagination'>";
    if ($page > 1) {
        echo "<a href='?page=" . ($page - 1) . "&search=" . urlencode($search) . "'><i class='bx bx-left-arrow-alt' ></i><p>Prev</p></a>";
    }
    echo " Page " . $page . " of " . $totalPages . " "; // Display current page number
    if ($page < $totalPages) {
        echo "<a href='?page=" . ($page + 1) . "&search=" . urlencode($search) . "'><p>Next</p><i class='bx bx-right-arrow-alt'></i></a>";
    }
    echo "</div>";
}
