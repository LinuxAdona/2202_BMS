<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

$totalResidentsQuery = "SELECT COUNT(*) as count FROM resident r
                        WHERE r.first_name LIKE '%$search%' OR r.last_name LIKE '%$search%' 
                        OR r.gender LIKE '%$search%'";
$totalResidentsResult = $conn->query($totalResidentsQuery);
$totalResidents = $totalResidentsResult->fetch_assoc()['count'];
$totalPages = ceil($totalResidents / $limit);

$sql = "SELECT r.resident_id, r.first_name, r.middle_name, r.last_name, r.gender
        FROM resident r
        JOIN family f ON r.family_id = f.family_id
        WHERE r.first_name LIKE '%$search%' OR r.last_name LIKE '%$search%' 
        OR r.gender LIKE '%$search%'
        ORDER BY r.first_name, r.last_name ASC
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
$counter = $offset + 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gender = ($row['gender'] == "Male") ? "<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAg5JREFUSEvllUFrE2EQhp/ZxFARoSBYSpSCB/GgUNBTUQxe/AVNg4qI2IJCD6nZ4kGhULCwG+hFQQM9leIu+QGCF7EIVryo9RKPCsVaEIVqDyY7+sU0JMtisjU9uddv5n2+eb+ZWWGXP9llff5TQNbW2wKzUfb6rrS5smOLcrYWFNwwpGcAIzxm6xxwqxXSM8BoXtNWkmXgSM8BIfEK8ASYNKB/ruDCTR2qWTwDhoCKtYezj+7KetZWV6DQEXBlRvu2fnANJd8o/5tABWWpluCpFfAYSAPvgiTnynOysW1RztZZz5U7rZa1dVFuSg9rol7usQ4TvhpUyZTn5UunTdAEZGY0OfCdFeAksCbKhCgvjcBv6IgqJWAACFLK4GJRPncSN+dNwNi03kC5D6wHMFx25VOrwMVpPVRVVoF+hEnfkXvxALa+BU4gXPIdWYpKzhZ0XISSKM+9opyJC9gC+gIYDN+++Yh/3ugDsOG7cjAuYBPYJ0Lac2QtKrlh00eUTb8o++MCXgGnRLjsObIYaZGtVwUWBF54rozEBUwAD035KeV4uEvM7WvKa4UDf7tEGBpuU1PFsGlThXGtspK0sGoJTovyoN6mwrLvkAHRWBWY4PoaMIOmHI1MVt5YKc6b1dCNeNscbCeM5nWvleA6wlRjJZhpea8w3/+VhVJJfnYrHgmIk9xN7I7/aN2Im5hfmFO9GUhgppoAAAAASUVORK5CYII='/>" : "<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAcJJREFUSEvtlkFLFHEYxn/Pzliy2s6IxBLWoU4dCqxDh+wgFEGHrq6hVBAieOkj9A3qFEh1SqOd7C5IBUEH6RQm3SIo2LKwZiuQyNk3ZtsV0x3HQfYQOLcZ5n1/z/u8z38Y0eZLbe5PKsCuWicr4TjoOnC4Iegd6CbfC3c1q19bidwSYMPLhzBnDjia0GSRjo7zmu76mARJBNiguRSrL4EToAponBzz9UYWncZ0ByginqvsD2YHlKoTYLeBJWpuv2a6P61vYiPLB1l1XgM+6JICr9wKkjxBKVwAjoNGFXgPWhXbUDiGiCd5qsA/lxWwAnRScw9sVN9s1NjRe+CrAr83K+An0IV+96m8v9Jygr82fQB+KPALGQHfXoAGwK4o6LnfEjAcXsO4h/FMj/yzGQFx9pkEvrDHOaapfZ83LTlyXmH0Il1W2ZvKBrhgeylU3wBH6jE1xjDmcZUjis4gxfAisEDNO6kZRZkA9bjHBw3nMcaphJw/IeeO6mH3UuZzsJaUi5U8+fwNYAToazx/i5gk8m4lKW/Wp36L/vG9FFp8r8Dfdt22X6xb9l8CmqoTl5hiV6pFbQfsLjl1Bzv9KWg74A9VcaUZ4MkBtAAAAABJRU5ErkJggg=='/>";

        echo "<tr>
                <td>" . $counter++ . "</td>
                <td>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</td>
                <td><div class='gender'>" . $gender . "<p>" . $row['gender'] . "</p></div></td>
                <td>
                    <div class='actions'>
                        <a href='view_resident.php?id=" . $row['resident_id'] . "' class='view-link'>
                            <div class='bx-action'>
                                <i class='bx bx-show'></i>
                                <p>View</p>
                            </div>
                        </a>
                        <form action='delete_resident.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['resident_id'] . "'>
                            <button type='submit' class='delete-link'>
                                <div class='bx-action'>
                                    <i class='bx bx-trash'></i>
                                    <p>Delete</p>
                                </div>
                            </button>
                        </form>
                    </div>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No residents found.</td></tr>";
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
