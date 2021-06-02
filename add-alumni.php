<?php
require_once "conn.php";

$name = $email = $gender = $dob = $batch = $branch = $phone = $curr_comp = $curr_job = $curr_loc = "";
$name_err = $email_err = $gender_err = $dob_err = $batch_err = $branch_err = $phone_err = $curr_comp_err = $curr_job_err = $curr_loc_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $name_err = "Name is required.";
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Email is required.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $check_email_query = "SELECT id from alumni WHERE email = ?";

        if ($stmt = mysqli_prepare($conn, $check_email_query)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already in use.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                $email_err = "Oops! Something went wrong.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty($_POST["genders"])) {
        $gender_err = "Gender is required.";
    } else {
        $gender = $_POST["genders"];
    }

    if (empty($_POST["dob"])) {
        $dob_err = "DOB is required.";
    } else {
        $dob = $_POST["dob"];
    }

    if (empty(trim($_POST["batch"]))) {
        $batch_err = "Batch is required.";
    } else {
        $batch = trim($_POST["batch"]);
    }

    if (empty($_POST["branches"])) {
        $branch_err = "Branch is required.";
    } else {
        $branch = $_POST["branches"];
    }

    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Mobile number is required.";
    } elseif (strlen(trim($_POST["phone"])) !== 10) {
        $phone_err = "Invalid mobile number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    if (empty(trim($_POST["curr_comp"]))) {
        $curr_comp_err = "Company name is required.";
    } else {
        $curr_comp = trim($_POST["curr_comp"]);
    }

    if (empty(trim($_POST["curr_job"]))) {
        $curr_job_err = "Job designation is required.";
    } else {
        $curr_job = trim($_POST["curr_job"]);
    }

    if (empty(trim($_POST["curr_loc"]))) {
        $curr_loc_err = "Job location is required.";
    } else {
        $curr_loc = trim($_POST["curr_loc"]);
    }

    if (
        empty($name_err) && empty($email_err) && empty($gender_err) && empty($dob_err) &&
        empty($batch_err) && empty($branch_err) && empty($phone_err) && empty($curr_comp_err) &&
        empty($curr_job_err) && empty($curr_loc_err)
    ) {
        $insert_alumni_query = "INSERT INTO alumni(`name`, `email`, `gender`, `dob`, `batch`, `branch`, `phone`, `current_comp`, `current_job`, `current_location`) VALUES 
        (?,?,?,?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($conn, $insert_alumni_query)) {
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_name, $param_email, $param_gender, $param_dob, $param_batch, $param_branch, $param_phone, $param_comp, $param_job, $param_loc);

            $param_name = $name;
            $param_email = $email;
            $param_gender = $gender;
            $param_dob = $dob;
            $param_batch = $batch;
            $param_branch = $branch;
            $param_phone = $phone;
            $param_comp = $curr_comp;
            $param_job = $curr_job;
            $param_loc = $curr_loc;

            if (mysqli_stmt_execute($stmt)) {
                header("location: alumni-list.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}

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
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">

                <h2 class="page-heading">Add Alumni</h2>

                <form class="custom-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>

                    <div class="form-group">
                        <select name="genders" id="genders" class="form-control">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $gender_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="date" name="dob" value="<?php echo $dob; ?>" placeholder="DOB" class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $dob_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" name="batch" value="<?php echo $batch; ?>" placeholder="Batch" class="form-control <?php echo (!empty($batch_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $batch_err; ?></span>
                    </div>

                    <div class="form-group">
                        <select name="branches" id="branches" class="form-control">
                            <option value="CSE">CSE</option>
                            <option value="ME">ME</option>
                            <option value="CE">CE</option>
                            <option value="ECE">ECE</option>
                            <option value="EE">EE</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $branch_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Mobile Number" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" name="curr_comp" value="<?php echo $curr_comp; ?>" placeholder="Current Company" class="form-control <?php echo (!empty($curr_comp_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $curr_comp_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" name="curr_job" value="<?php echo $curr_job; ?>" placeholder="Current Designation" class="form-control <?php echo (!empty($curr_job_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $curr_job_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" name="curr_loc" value="<?php echo $curr_loc; ?>" placeholder="Current Location" class="form-control <?php echo (!empty($curr_loc_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $curr_loc_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>