<?php include "../brgy_management/db.php"; ?>
<?php include "../brgy_management/tables/residents_info/resident_details.php"; ?>
<?php include "../brgy_management/tables/residents_info/resident_family.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management System | Linux Adona | BSIT 2202</title>
    <link rel="stylesheet" href="../styles/residents/info.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php
    $resident_id = isset($_GET['id']) ? $_GET['id'] : 0;
    $resident = getResidentDetails($conn, $resident_id);
    ?>

    <div class="sidebar">
        <div class="brgy-logo">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAPtJREFUSEvd1UErB0EYx/HPvyQuckDKwYWSg+TmoFzcvRpvwTsSpeTCSU4uSiQXeQGOmNrVtmba2cYc2NvWzPc7z/PMr5mo/E0q8w0JDnGMjcyD3OEIJ+36IcErljLh7bIHrOUKPkbCf3CHKvh/grbitrL+f3GLflUwg/daQ57FGfZqCOZw+iXYxSOmsZIQjZ7BPC6xhaemgilcYzkiGSUIib3AZgf+0kBDMq+wmNmy73x1g3aL7QawiucebAc3JYJ7rDeA2HVcwFtPMKpFYW8qQAFURdA9cEyQ6lh0BrEK/q4g87IklyVbFHKwX0g/x0Hui1boMvjoFws+AS+QLxnB09RAAAAAAElFTkSuQmCC" />
            <h2>Barangay</h2>
        </div>
        <div class="nav">
            <ul>
                <li><a href="../index.php">Home</a></li>
            </ul>
            <ul>
                <div class="seperator">MENU</div>
                <div class="menu">
                    <li>
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAANVJREFUSEu11j9qAkEUB+DP24kXMIiNpLO2SG0g9jaeIG0OELSxDzlAIJhCSCkWIohoBnbBIsv+cd/AVgu/b5l5+950BK9OcL4i4AcbjPB9z0cUAZcs9IAJFk2RMiDPXWGI37pQVSDl7vCItzpIHSDPfcUY+ypQEyDlbjHAugxpCqTcVAhzPP09xyLoHiDP/EIfn/8hbQAp94QpZjjfQm0BeeYS3VukbeAdvQggbdEzXiK2KOyQQ8s09EcLaxWhzS6sXYcNnI+snh+iRmZZF678PvxWcQWoeUAZZIKJWAAAAABJRU5ErkJggg==" />
                        <a href="residents.php">Residents</a>
                    </li>
                    <li class="active">
                        <i class='bx bx-dots-vertical-rounded'></i>
                        <?php
                        $resident_id = isset($_GET["id"]) ? $_GET["id"] : 0;
                        echo "<a href='view_resident.php?id=" . $resident_id . "'>View Resident</a>";
                        ?>
                    </li>
                    <li>
                        <a href="../families-page/families.php">Families</a>
                    </li>
                    <li>
                        <a href="../officials-page/officials.php">Officials</a>
                    </li>
                    <li>
                        <a href="../houses-page/houses.php">Houses</a>
                    </li>
                </div>
            </ul>
        </div>
        <div class="session">
            <div class="user">
                <a href="https://www.facebook.com/Linux.Sale.Adona">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAZxJREFUSEu11L1vjWEYx/HPSecmmgpCajHUaOofIF5K01EbU/8CidCkpoYNIQzduyojUukLo9UmBgtB21RIGQnPldxtTh7nPveTU+da7/v6fa/3lj5bq8/6mgImq0Bu4kQK6D3m8bwUYBPAHG5nhGZxvxukBDiPF9hAgFaS2DncwRGcwXoOUgKsJoFpPK6JTGEJy7jYK+AbDlRlGMTPmsgwtvEZx3oFbOIQDuJrBhB/olQdrVSiqPlZRDmeZEoUPbrQK6C9yTEx0ZOBBL2Lw/ttcgR2DSEWwu32u+pLQB/uZ0x3fUdxHTGev/Ayzf+7/7FoJY2u792aHOMZUY/hVJqmdrEtvMHrlM2PTqQcIKZiMTWxSQaxCzNYq3/uBJjAs/TxKW4hjtv3mnNkGMcv3sMnLAKLsd2zOmAIb1PkcWtuNAkf91I5v+BkNXk7u351wFU8wCucbige30InljIO35Vq8xdygDhol0rLkwGPp8P3CJdzgA8YQZSqXvNSQkfxCR9xPAf4kx5KNyoH+8e/V6FSNtkpauzY9GPfM/gL5dBHGcZ57nQAAAAASUVORK5CYII=" />
                    <p>Linux Adona</p>
                </a>
            </div>
        </div>
    </div>

    <div class="main">
        <header>
            <h2>Resident Info</h2>
        </header>

        <div class="content">
            <div class="left-bx">
                <div class="resident-bx">
                    <h2>
                        <?php echo $resident ? $resident['first_name'] . " " . $resident['middle_name'] . " " . $resident['last_name'] : "Resident not found."; ?>
                    </h2>
                    <p><?php echo getFamilyName($conn, $resident['family_id'] ?? 0); ?> Family</p>
                </div>
                <div class="resident-info-bx">

                    <div class="info-bx">
                        <?php echo getGender($conn, $resident_id ?? 0); ?>
                        <h4><?php echo $resident['gender'] ?? "N/A"; ?></h4>
                    </div>

                    <div class="info-bx">
                        <i class='bx bxs-face'></i>
                        <h4>Family Head</h4>
                    </div>
                    <p><?php echo getFamilyHead($conn, $resident['family_id'] ?? 0) ?></p>

                    <div class="info-bx">
                        <i class='bx bxs-contact'></i>
                        <h4>Phone Number</h4>
                    </div>
                    <p><?php echo $resident['contact_number'] ?? "N/A"; ?></p>

                    <div class="info-bx">
                        <i class='bx bxs-building-house'></i>
                        <h4>Address</h4>
                    </div>
                    <p><?php echo isset($resident) ? $resident['house_number'] . " " . $resident['street'] : 'N/A'; ?></p>

                    <div class="info-bx">
                        <i class='bx bxs-calendar'></i>
                        <h4>Date of Birth</h4>
                    </div>
                    <p><?php echo isset($resident['date_of_birth']) ? date("F j, Y", strtotime($resident['date_of_birth'])) : 'N/A'; ?></p>
                </div>
            </div>

            <div class="right-bx">
                <h2>Family Members</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Relationship</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo loadFamilyMembers($conn, $resident['family_id'] ?? 0, $resident_id); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer>
            <div class="bsu-logo">
                <img src="../imgs/Batangas_State_Logo.png">
                <p>Batangas State University - ARASOF</p>
            </div>
            <p>Created by Linux Adona from BSIT-2202</p>
        </footer>
    </div>

    <script src="../script.js"></script>

</body>

</html>