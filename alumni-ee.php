<?php require_once "conn.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Search engine for college alumni.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000" />

    <title>Alumni Search Engine</title>

    <link rel="favicon" href="logo.png">
    <link rel="apple-touch-icon" href="logo.png">
    <link rel="stylesheet" href="required/css/bootstrap.min.css">
    <link rel="stylesheet" href="required/css/style.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/alumni-search-engine">Alumni Search Engine</a>
            <a class="text-btn" href="add-alumni.php">Add Alumni</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">

                <h2 class="page-heading">EE Alumni List</h2>

                <?php

                $fetch_alumni = "SELECT * FROM alumni WHERE branch='EE'";
                $result = mysqli_query($conn, $fetch_alumni);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>id</th>";
                    echo "<th>name</th>";
                    echo "<th>sex</th>";
                    echo "<th>email</th>";
                    echo "<th>batch</th>";
                    echo "<th>branch</th>";
                    echo "<th>Company</th>";
                    echo "<th>Position</th>";
                    echo "<th>Location</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['batch'] . "</td>";
                        echo "<td>" . $row['branch'] . "</td>";
                        echo "<td>" . $row['current_comp'] . "</td>";
                        echo "<td>" . $row['current_job'] . "</td>";
                        echo "<td>" . $row['current_location'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($result);
                } else {
                    echo "No records matching your query were found.";
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>

</body>

</html>