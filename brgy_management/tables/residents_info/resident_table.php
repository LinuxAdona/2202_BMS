<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT r.resident_id, r.first_name, r.middle_name, r.last_name, r.gender, a.house_number, a.street
        FROM resident r
        JOIN address a ON r.address_id = a.address_id
        WHERE r.first_name LIKE '%$search%' OR r.last_name LIKE '%$search%' 
        OR a.house_number LIKE '%$search%' OR a.street LIKE '%$search%' OR r.gender LIKE '%$search%'
        ORDER BY r.first_name, r.last_name ASC";
$result = $conn->query($sql);

$counter = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $counter++;
        $gender = "";

        if ($row['gender'] == "Male") {
            $gender = "<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAg5JREFUSEvllUFrE2EQhp/ZxFARoSBYSpSCB/GgUNBTUQxe/AVNg4qI2IJCD6nZ4kGhULCwG+hFQQM9leIu+QGCF7EIVryo9RKPCsVaEIVqDyY7+sU0JMtisjU9uddv5n2+eb+ZWWGXP9llff5TQNbW2wKzUfb6rrS5smOLcrYWFNwwpGcAIzxm6xxwqxXSM8BoXtNWkmXgSM8BIfEK8ASYNKB/ruDCTR2qWTwDhoCKtYezj+7KetZWV6DQEXBlRvu2fnANJd8o/5tABWWpluCpFfAYSAPvgiTnynOysW1RztZZz5U7rZa1dVFuSg9rol7usQ4TvhpUyZTn5UunTdAEZGY0OfCdFeAksCbKhCgvjcBv6IgqJWAACFLK4GJRPncSN+dNwNi03kC5D6wHMFx25VOrwMVpPVRVVoF+hEnfkXvxALa+BU4gXPIdWYpKzhZ0XISSKM+9opyJC9gC+gIYDN+++Yh/3ugDsOG7cjAuYBPYJ0Lac2QtKrlh00eUTb8o++MCXgGnRLjsObIYaZGtVwUWBF54rozEBUwAD035KeV4uEvM7WvKa4UDf7tEGBpuU1PFsGlThXGtspK0sGoJTovyoN6mwrLvkAHRWBWY4PoaMIOmHI1MVt5YKc6b1dCNeNscbCeM5nWvleA6wlRjJZhpea8w3/+VhVJJfnYrHgmIk9xN7I7/aN2Im5hfmFO9GUhgppoAAAAASUVORK5CYII='/>";
        } else {
            $gender = "<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAcJJREFUSEvtlkFLFHEYxn/Pzliy2s6IxBLWoU4dCqxDh+wgFEGHrq6hVBAieOkj9A3qFEh1SqOd7C5IBUEH6RQm3SIo2LKwZiuQyNk3ZtsV0x3HQfYQOLcZ5n1/z/u8z38Y0eZLbe5PKsCuWicr4TjoOnC4Iegd6CbfC3c1q19bidwSYMPLhzBnDjia0GSRjo7zmu76mARJBNiguRSrL4EToAponBzz9UYWncZ0ByginqvsD2YHlKoTYLeBJWpuv2a6P61vYiPLB1l1XgM+6JICr9wKkjxBKVwAjoNGFXgPWhXbUDiGiCd5qsA/lxWwAnRScw9sVN9s1NjRe+CrAr83K+An0IV+96m8v9Jygr82fQB+KPALGQHfXoAGwK4o6LnfEjAcXsO4h/FMj/yzGQFx9pkEvrDHOaapfZ83LTlyXmH0Il1W2ZvKBrhgeylU3wBH6jE1xjDmcZUjis4gxfAisEDNO6kZRZkA9bjHBw3nMcaphJw/IeeO6mH3UuZzsJaUi5U8+fwNYAToazx/i5gk8m4lKW/Wp36L/vG9FFp8r8Dfdt22X6xb9l8CmqoTl5hiV6pFbQfsLjl1Bzv9KWg74A9VcaUZ4MkBtAAAAABJRU5ErkJggg=='/>";
        }

        $to_string = "<tr>
                        <td>" . $counter . "</td>
                        <td>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</td>
                        <td>
                            <div class='gender'>" . $gender . "<p>" . $row['gender'] . "</p></td>
                        <td>
                            <div class='actions'>
                                <a href='view_resident.php?id=" . $row['resident_id'] . "' class='view-link'>
                                    <div class='bx-action'>
                                        <i class='bx bx-show' ></i>
                                        <p>View</p>
                                    </div>
                                </a>
                                <a href='delete_resident.php?id=" . $row['resident_id'] . "' class='delete-link'>
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
    echo "<tr><td colspan='5'>No residents found.</td></tr>";
}
