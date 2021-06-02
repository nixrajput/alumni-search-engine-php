<?php
require_once "conn.php";
?>

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

    <div class="center-div">
        <div class="btn-card">
            <a class="page-links" href="alumni-list.php">All Alumni</a>
            <a class="page-links" href="alumni-cse.php">CSE Alumni</a>
            <a class="page-links" href="alumni-me.php">ME Alumni</a>
            <a class="page-links" href="alumni-ce.php">CE Alumni</a>
            <a class="page-links" href="alumni-ece.php">ECE Alumni</a>
            <a class="page-links" href="alumni-ee.php">EE Alumni</a>
        </div>
    </div>

    <script src="required/js/bootstrap.bundle.min.js"></script>
</body>

</html>