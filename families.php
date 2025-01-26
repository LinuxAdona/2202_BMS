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
            <img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAPtJREFUSEvd1UErB0EYx/HPvyQuckDKwYWSg+TmoFzcvRpvwTsSpeTCSU4uSiQXeQGOmNrVtmba2cYc2NvWzPc7z/PMr5mo/E0q8w0JDnGMjcyD3OEIJ+36IcErljLh7bIHrOUKPkbCf3CHKvh/grbitrL+f3GLflUwg/daQ57FGfZqCOZw+iXYxSOmsZIQjZ7BPC6xhaemgilcYzkiGSUIib3AZgf+0kBDMq+wmNmy73x1g3aL7QawiucebAc3JYJ7rDeA2HVcwFtPMKpFYW8qQAFURdA9cEyQ6lh0BrEK/q4g87IklyVbFHKwX0g/x0Hui1boMvjoFws+AS+QLxnB09RAAAAAAElFTkSuQmCC" />
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
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAANVJREFUSEu11j9qAkEUB+DP24kXMIiNpLO2SG0g9jaeIG0OELSxDzlAIJhCSCkWIohoBnbBIsv+cd/AVgu/b5l5+950BK9OcL4i4AcbjPB9z0cUAZcs9IAJFk2RMiDPXWGI37pQVSDl7vCItzpIHSDPfcUY+ypQEyDlbjHAugxpCqTcVAhzPP09xyLoHiDP/EIfn/8hbQAp94QpZjjfQm0BeeYS3VukbeAdvQggbdEzXiK2KOyQQ8s09EcLaxWhzS6sXYcNnI+snh+iRmZZF678PvxWcQWoeUAZZIKJWAAAAABJRU5ErkJggg==" />
                        <a href="households.php">Households</a>
                    </li>

                    <li>
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAANVJREFUSEu11j9qAkEUB+DP24kXMIiNpLO2SG0g9jaeIG0OELSxDzlAIJhCSCkWIohoBnbBIsv+cd/AVgu/b5l5+950BK9OcL4i4AcbjPB9z0cUAZcs9IAJFk2RMiDPXWGI37pQVSDl7vCItzpIHSDPfcUY+ypQEyDlbjHAugxpCqTcVAhzPP09xyLoHiDP/EIfn/8hbQAp94QpZjjfQm0BeeYS3VukbeAdvQggbdEzXiK2KOyQQ8s09EcLaxWhzS6sXYcNnI+snh+iRmZZF678PvxWcQWoeUAZZIKJWAAAAABJRU5ErkJggg==" />
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

            </div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT r.resident_id, r.first_name, r.last_name, r.gender, a.house_number, a.street
                            FROM resident r
                            JOIN address a ON r.address_id = a.address_id";
                    $result = $conn->query($sql);

                    $gender = "";

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row["gender"] == "Male") {
                                $gender = '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAhJJREFUSEvllT9oU1EUxn8nTbUiLYJgLVEKDuKgUNCpKAYXQUwKgps4iK0odFA6iH/6XtOAQ0EXBS10EicH8QkWuohFsOKi1iWOCmItCELAf4mfve2LJGk0eTWdvHCXxznf757vnnuescrLVlmf/xSQzugSYrSWvYFnFa6s2KJURkMmxqohTQM44ZSvK2acL4c0DXA4q0SsyDSwremAKvGcwZRg0IH+uYJDWXW3Fnks6AZyxNkfXLS5Pl9jMobqApK+2jpinEScDcv/LMjFjDvAI4lJIGHw+nsrByYv2HzJorSv0cC3y+WWVXRRX1ZbVWQK2FHnhc+uFcm7vn2qNwl+A5K+4u3GjMFu4P3CHpB45gQWPO7FGAc6gZ8touuebx/riYe5S2GpjM6YuAHMFUTPQ98+lAsc8bWlYMwCGzAGg2G7HgmQHtErYBdwLPDM+b1spUfUD4uVPAk82xcV8AVoK4iu6tOXhMI7egvMB55tigrIA+sRicA3dwfLVmjTOyAfeNYeFfAc2CM4/sCz2zUtyugEYsLg6X3PeiMBUhkNmLjlym8RO6u7JDz9C2Dj3w5RDa1o0w7DVdHj2tRE/xqY+QoxYK8ZN8M2nQ6GSWKmSBW4YDcG4ksPbfsfkl8S56AbDY2IV7yDUsLRq1r3Lc9pxDk3EsLvbzCube5kYvyU/WhUvCYgSnIjsSv+ozUi7mJ+AYL2uhnf1aakAAAAAElFTkSuQmCC"/>';
                            } else {
                                $gender = '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAchJREFUSEvtls9rE1EUhb+TpDb4I+a1VJHqQlcuFNSFC+0ioAgukoI7seiilIAb/wT/A10JpXWlCILS0im0UFQQXBRXUsWdFBSiVZoMWFDJxCuZNqIy0+kgWQjO8vHu+e47577HiC5/6rI+iQArLecpFKvANeDgRkPLYDdouknN69tmTW4KsOHVA1h2AexwpIh4RTY4p6mB93GQWICVLEfBfw4cB2qYVSG3GAqpdQqYAPYCT+W5UnpAuX4V6RawQtA8prk9H34VsQur+wkyL4Ei2EV5ffejIPEnqDSWgKNgI/L67kUVW8UfA5tAPNaMO5sSUP8CyhM09/3ZfUdoPaPMW4y6Zl1/SkBjDdgBwaC8gVrkCdZtegd8lucKaQHPgNOIK5pxdyIBZX8U2W3giTx3Jh1g2K9iNg58Ips7ouldHyNCfgH0Y1zWrLubDnDeeunxXwOHwjGVjbEtu8hXZaA1hGjD22O6RG/xhB6olQrQ3hyG+D3zEHEyZs4fQc+IvJ0rqe/Bz0kp17aj/HXQJWBwY/0NpnHyu2/Gdd6pT3yLfvO90rDwIntuy3Vb3hha9k8COl3HhphgV6JFXQf8Dzkxg7/9Keg64Ac+16kZk6BgDwAAAABJRU5ErkJggg=="/>';
                            }

                            echo "<tr>
                                    <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
                                    <td>
                                    <div class='gender'>"
                                . $gender . $row['gender'] .
                                "</div>
                                    </td>
                                    <td>" . $row['house_number'] . " " . $row['street'] . "</td>
                                    <td>
                                        <div class='actions'>
                                            <a class='view-link' href='view_resident.php?id=" . $row['resident_id'] . "'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAd9JREFUSEvt1EuojlEUBuDnoCShKEkRynVCmGBCDMiAkWsM5DJkRklnYGKGYkKZIDFzyUhyiwFSysQtSbkMKKTc7VX76Du77z979M/OV3+7f++117ved71r9+jy19Pl/AYBqgrXJJqIjViNyZiQM77Da1zBGXzohNQJYCwOYldah1bK/IXjOIAvZWwbwGxcQ1T/I60ncA/P8i9yTMcMLMHOXMRLLMvM/uOUAFPwAONwF1vxosJgZgI8iwV4k2RbiPd9d5oAw5LW9zEPt7ACP3PgNBzDSnxN/TiFPQ3gEZnl3MTiJpa2AezFIbzCfHxqJLiKVQWTowVImOARon/B/HTENxmEhlNT0JoEcKlI9qeIjeNo6OgibjtO4mGWqh/AE8zB+rReKC5+xqhirw1gc7btY4Rc/QA24FxuVBx+bCQ8kiTbXZEoXBcSjcdaXCwBhqTG3sEi3M6W+12AbMv/yyYPz66L3l1P95e3NTn2xuQZCKsF2Jbc9IGc2rTpjTz13zoBxP7I5OnLmUEMWkxp2PcpniPsHLadhcXYkQctjLEO35vVdHoq4nnoTXOwHyHdQF8UsS+xP9wWVHvsJqXKN+UB63vs/qY36m2WLpieb05uCVIDqBRfPx4EqGrUdYn+AW7RVxkKyEc6AAAAAElFTkSuQmCC'/></a> |
                                            <a class='edit-link' href='edit_resident.php?id=" . $row['resident_id'] . "'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAWdJREFUSEvFlLlKRDEUhr9pLOwEcQoFwUJRcasVt9Z3EsX38QnGfXkDC/cFRRQLtXCpND+cyJ0xud7ccZg0uWSG7zv5c5IKLR6VFvNpRtABLAGdwDrwHiq2rKAL2AQmDXoJzAM3jZIyAsG3gAngHngFhux7CnjISlIF3cCGi2QcOAMWgQ+gZmurDr5SVtDjYtgGhg1wbrF8mnQMWAOWywiqFovgj8AzMAjcAm/2rXVJNP+MIhEJfggMAHfucGeBFxfPLjBiJL9+kXrIjfBp4BrIdpHgfv1Xp+btoNeq9JVn4XvAqMnmbA7e2ZhA8AOg32KJwbWuHURHSCDozn/AZQ0JrgyuWbdTmav/dXPVJaeugIW/KvdbCgm+7Mc+gwiu/lfmJ9ZFdbc1NSIvkFzwfXsKjt1d0IEWhsci8oJsYYLPAE+pz3teRJ51ZGeRDI/tILXI3P8XeSqaEhaJKFVQx2yLILXi9p7BNyiKUBlj03X8AAAAAElFTkSuQmCC'/></a> |
                                            <a class='delete-link' href='delete_resident.php?id=" . $row['resident_id'] . "'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAKRJREFUSEvtlUEKgCAQRV93CYK6TsdpGXSZrlPQaYpAXVjDt8xd7mR03v8z6FQUXlXh/ChAD4xAYwjZgAGYLaEKsACtcLkC3VvA7i5aQlRclkglUPELwF/I7X1wHFsvDvDKpfXIonn+dfO+BsQK1T7wUx2ohNkl+gGXd/W0JH8P5NeUXSJFeAxIGTQx9HbwWC/5HJUTUCvpLm6OTjUyE/Pbx4oDDlBhOBmYaWrOAAAAAElFTkSuQmCC'/></a>
                                        </div>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No residents found.</td></tr>";
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


</body>

</html>