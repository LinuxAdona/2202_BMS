<?php include "brgy_management/db.php"; ?>
<?php include "brgy_management/counter.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management System | Linux Adona | BSIT 2202</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <div class="sidebar">
        <div class="brgy-logo">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAPtJREFUSEvd1UErB0EYx/HPvyQuckDKwYWSg+TmoFzcvRpvwTsSpeTCSU4uSiQXeQGOmNrVtmba2cYc2NvWzPc7z/PMr5mo/E0q8w0JDnGMjcyD3OEIJ+36IcErljLh7bIHrOUKPkbCf3CHKvh/grbitrL+f3GLflUwg/daQ57FGfZqCOZw+iXYxSOmsZIQjZ7BPC6xhaemgilcYzkiGSUIib3AZgf+0kBDMq+wmNmy73x1g3aL7QawiucebAc3JYJ7rDeA2HVcwFtPMKpFYW8qQAFURdA9cEyQ6lh0BrEK/q4g87IklyVbFHKwX0g/x0Hui1boMvjoFws+AS+QLxnB09RAAAAAAElFTkSuQmCC" />
            <h2>Barangay</h2>
        </div>
        <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
            <ul>
                <div class="seperator">MENU</div>
                <div class="menu">
                    <li>
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAANVJREFUSEu11j9qAkEUB+DP24kXMIiNpLO2SG0g9jaeIG0OELSxDzlAIJhCSCkWIohoBnbBIsv+cd/AVgu/b5l5+950BK9OcL4i4AcbjPB9z0cUAZcs9IAJFk2RMiDPXWGI37pQVSDl7vCItzpIHSDPfcUY+ypQEyDlbjHAugxpCqTcVAhzPP09xyLoHiDP/EIfn/8hbQAp94QpZjjfQm0BeeYS3VukbeAdvQggbdEzXiK2KOyQQ8s09EcLaxWhzS6sXYcNnI+snh+iRmZZF678PvxWcQWoeUAZZIKJWAAAAABJRU5ErkJggg==" />
                        <a href="families.php" class="active">Families</a>
                    </li>
                    <li>
                        <a href="households.php">Households</a>
                    </li>

                    <li>
                        <a href="officials.php">Officials</a>
                    </li>
                </div>
            </ul>
        </div>
        <div class="session">
            <div class="user">
                <a href="https://www.facebook.com/Linux.Sale.Adona">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAZxJREFUSEu11L1vjWEYx/HPSecmmgpCajHUaOofIF5K01EbU/8CidCkpoYNIQzduyojUukLo9UmBgtB21RIGQnPldxtTh7nPveTU+da7/v6fa/3lj5bq8/6mgImq0Bu4kQK6D3m8bwUYBPAHG5nhGZxvxukBDiPF9hAgFaS2DncwRGcwXoOUgKsJoFpPK6JTGEJy7jYK+AbDlRlGMTPmsgwtvEZx3oFbOIQDuJrBhB/olQdrVSiqPlZRDmeZEoUPbrQK6C9yTEx0ZOBBL2Lw/ttcgR2DSEWwu32u+pLQB/uZ0x3fUdxHTGev/Ayzf+7/7FoJY2u792aHOMZUY/hVJqmdrEtvMHrlM2PTqQcIKZiMTWxSQaxCzNYq3/uBJjAs/TxKW4hjtv3mnNkGMcv3sMnLAKLsd2zOmAIb1PkcWtuNAkf91I5v+BkNXk7u351wFU8wCucbige30InljIO35Vq8xdygDhol0rLkwGPp8P3CJdzgA8YQZSqXvNSQkfxCR9xPAf4kx5KNyoH+8e/V6FSNtkpauzY9GPfM/gL5dBHGcZ57nQAAAAASUVORK5CYII=" />
                    <p>Linux Adona</p>
                </a>
            </div>
        </div>
    </div>

    <div class="main">
        <header>
            <h2>Families</h2>
        </header>

        <div class="content">
            <div class="bx">
                <h3>Resident List</h3>
                <form method="POST" action="" onsubmit="return refreshTable();">
                    <input type="text" name="search" placeholder="Search" required>
                    <button type="submit">Search</button>
                    <button type="button" onclick="resetSearch()">Refresh</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $sql = "SELECT r.resident_id, r.first_name, r.middle_name, r.last_name, r.gender, a.house_number, a.street
                            FROM resident r
                            JOIN address a ON r.address_id = a.address_id
                            WHERE r.first_name LIKE '%$search%' OR r.last_name LIKE '%$search%' 
                            OR a.house_number LIKE '%$search%' OR a.street LIKE '%$search%' OR r.gender LIKE '%$search%'";
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

                            echo "<tr>
                                    <td>" . $counter . "</td>
                                    <td>" . $row['first_name'] . " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</td>
                                    <td>
                                        <div class='gender'>" . $gender . "<p>" . $row['gender'] . "</p></td>
                                    <td>" . $row['house_number'] . " " . $row['street'] . "</td>
                                    <td>
                                        <div class='actions'>
                                            <a href='view_resident.php?id=" . $row['resident_id'] . "' class='view-link'>
                                                <div class='view-action'>
                                                    <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAd9JREFUSEvt1EuojlEUBuDnoCShKEkRynVCmGBCDMiAkWsM5DJkRklnYGKGYkKZIDFzyUhyiwFSysQtSbkMKKTc7VX76Du77z979M/OV3+7f++117ved71r9+jy19Pl/AYBqgrXJJqIjViNyZiQM77Da1zBGXzohNQJYCwOYldah1bK/IXjOIAvZWwbwGxcQ1T/I60ncA/P8i9yTMcMLMHOXMRLLMvM/uOUAFPwAONwF1vxosJgZgI8iwV4k2RbiPd9d5oAw5LW9zEPt7ACP3PgNBzDSnxN/TiFPQ3gEZnl3MTiJpa2AezFIbzCfHxqJLiKVQWTowVImOARon/B/HTENxmEhlNT0JoEcKlI9qeIjeNo6OgibjtO4mGWqh/AE8zB+rReKC5+xqhirw1gc7btY4Rc/QA24FxuVBx+bCQ8kiTbXZEoXBcSjcdaXCwBhqTG3sEi3M6W+12AbMv/yyYPz66L3l1P95e3NTn2xuQZCKsF2Jbc9IGc2rTpjTz13zoBxP7I5OnLmUEMWkxp2PcpniPsHLadhcXYkQctjLEO35vVdHoq4nnoTXOwHyHdQF8UsS+xP9wWVHvsJqXKN+UB63vs/qY36m2WLpieb05uCVIDqBRfPx4EqGrUdYn+AW7RVxkKyEc6AAAAAElFTkSuQmCC' class='view-image' />
                                                    <p>View</p>
                                                </div>
                                            </a>
                                            <a href='edit_resident.php?id=" . $row['resident_id'] . "' class='edit-link'>
                                                <div class='edit-action'>
                                                    <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAZdJREFUSEu11TnPDWEYxvHf2xAlEQpiS+xrKSGWaCQK38BXUGs0GlrfQa0TFWLtJYpX7EFCFAprg3PJfWQyzjJn3vc8zWRmnvlf93LdzyyY81qYM99yCKzAGazCdXxvBt0WOIvL2DUhs184h2tYjVs4VPsXcRifh9+3Bd5iQ0f4moIfxDt8wU48wkn8DKct8Lvg00q3tuD78Qyn8LWeHcB5XO0rsA53sLuCeT64P1ERp1z7cAkX+wisx+2Cv6+otyOl/YYd+IhklutMJQr8IbZVzY+UYyK4p7JJL44NTPBiXJPH9SCNv9uCvy4X3cPehmie/1tdmhz4A2xuQWLRITzQ48j19MCqN7tm0BWecqU8gWfYMnR/17QMXmIL3lSEr9C2aBwUeNYPrGxypwkMe7KxIIHHoqn502roh0bJ/+thV4HsC/x+TWuOhNS8CY9Ob4GmMQI/ik8jjpQlCzypqR0F75XBhHNv5KuZM1h2gQzKplmprf2x8tZxc5AfzpVySh+dx4NT9QJujBPoA534zbQfy5IF5y7wB1dYahkZIgF+AAAAAElFTkSuQmCC' class='edit-image' />
                                                    <p>Edit</p>
                                                </div>
                                            </a>
                                            <a href='delete_resident.php?id=" . $row['resident_id'] . "' class='delete-link'>
                                                <div class='delete-action'>
                                                    <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAKRJREFUSEvtlUEKgCAQRV93CYK6TsdpGXSZrlPQaYpAXVjDt8xd7mR03v8z6FQUXlXh/ChAD4xAYwjZgAGYLaEKsACtcLkC3VvA7i5aQlRclkglUPELwF/I7X1wHFsvDvDKpfXIonn+dfO+BsQK1T7wUx2ohNkl+gGXd/W0JH8P5NeUXSJFeAxIGTQx9HbwWC/5HJUTUCvpLm6OTjUyE/Pbx4oDDlBhOBmYaWrOAAAAAElFTkSuQmCC' class='delete-image' />
                                                    <p>Delete</p>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No residents found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <footer>
            <div class="bsu-logo">
                <img src="imgs/Batangas_State_Logo.png">
                <p>Batangas State University - ARASOF</p>
            </div>
            <p>Created by Linux Adona from BSIT-2202</p>
        </footer>
    </div>

    <script src="script.js"></script>

</body>

</html>