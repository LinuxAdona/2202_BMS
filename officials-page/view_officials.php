<?php include "../brgy_management/db.php"; ?>
<?php include "../brgy_management/tables/officials_info/details.php"; ?>
<?php include "../brgy_management/tables/officials_info/members.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management System | Official Details</title>
    <link rel="stylesheet" href="../styles/officials/info.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

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
                        <a href="../residents-page/residents.php">Residents</a>
                    </li>
                    <li>
                        <a href="../families-page/families.php">Families</a>
                    </li>
                    <li>
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAANVJREFUSEu11j9qAkEUB+DP24kXMIiNpLO2SG0g9jaeIG0OELSxDzlAIJhCSCkWIohoBnbBIsv+cd/AVgu/b5l5+950BK9OcL4i4AcbjPB9z0cUAZcs9IAJFk2RMiDPXWGI37pQVSDl7vCItzpIHSDPfcUY+ypQEyDlbjHAugxpCqTcVAhzPP09xyLoHiDP/EIfn/8hbQAp94QpZjjfQm0BeeYS3VukbeAdvQggbdEzXiK2KOyQQ8s09EcLaxWhzS6sXYcNnI+snh+iRmZZF678PvxWcQWoeUAZZIKJWAAAAABJRU5ErkJggg==" />
                        <a href="../officials-page/officials.php">Officials</a>
                    </li>
                    <li class="active">
                        <i class='bx bx-dots-vertical-rounded'></i>
                        <?php
                        $officials_id = isset($_GET['id']) ? $_GET['id'] : 0;
                        echo "<a href='view_officials.php?id=" . $officials_id . "'>View Officials</a>";
                        ?>
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
            <h2>Officials Info</h2>
        </header>

        <?php
        $officials_id = isset($_GET['id']) ? $_GET['id'] : 0;
        $official_details = getOfficialsDetails($conn, $officials_id);

        if (!$official_details) {
            echo "<p>No official found with ID: $officials_id</p>";
            exit;
        }

        $official_members = loadOfficialMembers($conn, $officials_id);
        ?>

        <div class="content">
            <div class="left-bx">
                <div class="official-bx">
                    <h2>
                        <?php echo $official_details['first_name'] . " " . $official_details['middle_name'] . " " . $official_details['last_name']; ?>
                    </h2>
                    <p><?php echo $official_details['position'] ?? "N/A"; ?></p>
                </div>
                <div class="official-info-bx">
                    <div class="info-bx">
                        <?php echo getGender($conn, $officials_id); ?>
                        <h4><?php echo $official_details['gender'] ?? "N/A"; ?></h4>
                    </div>

                    <div class="info-bx">
                        <i class='bx bxs-home'></i>
                        <h4>Family</h4>
                    </div>
                    <p><?php echo getFamilyName($conn, $official_details['family_id']); ?> Family</p>

                    <div class="info-bx">
                        <i class='bx bxs-face'></i>
                        <h4>Family Head</h4>
                    </div>
                    <p><?php echo getFamilyHead($conn, $official_details['family_id'] ?? 0) ?></p>

                    <div class="info-bx">
                        <i class='bx bxs-contact'></i>
                        <h4>Phone Number</h4>
                    </div>
                    <p><?php echo $official_details['contact_number'] ?? "N/A"; ?></p>

                    <div class="info-bx">
                        <i class='bx bxs-building-house'></i>
                        <h4>Address</h4>
                    </div>
                    <p><?php echo isset($official_details) ? $official_details['house_number'] . " " . $official_details['street'] : 'N/A'; ?></p>

                    <div class="info-bx">
                        <i class='bx bxs-calendar'></i>
                        <h4>Date of Birth</h4>
                    </div>
                    <p><?php echo isset($official_details['date_of_birth']) ? date("F j, Y", strtotime($official_details['date_of_birth'])) : 'N/A'; ?></p>
                </div>
            </div>

            <div class="right-bx">
                <h2>Other Officials</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $official_members; ?>
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