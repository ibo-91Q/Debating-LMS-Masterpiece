<?php
// Start session
session_start();

// Check if already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Database connection parameters
$host = "localhost";
$dbname = "debateskills";
$username = "root";
$password = "";

// Establish database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize variables
$first_name = $last_name = $email = $password = "";
$first_name_err = $last_name_err = $email_err = $password_err = $terms_err = "";

// Process form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate first name
    if(empty(trim($_POST["firstName"]))) {
        $first_name_err = "Please enter your first name.";
    } else {
        $first_name = trim($_POST["firstName"]);
    }
    
    // Validate last name
    if(empty(trim($_POST["lastName"]))) {
        $last_name_err = "Please enter your last name.";
    } else {
        $last_name = trim($_POST["lastName"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = :email";
        
        if($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        // Check if password contains at least one number and one symbol
        $password = trim($_POST["password"]);
        if(!preg_match('/[0-9]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
            $password_err = "Password must include at least one number and one symbol.";
        }
    }
    
    // Validate terms agreement
    if(!isset($_POST["termsAgree"])) {
        $terms_err = "You must agree to the Terms of Service and Privacy Policy.";
    }
    
    // Check input errors before inserting into database
    if(empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($terms_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
         
        if($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()) {
                // Redirect to login page
                header("location: login.php?registered=true");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DebateSkills - Sign Up</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2563EB;
            --primary-light: #EFF6FF;
            --success-color: #10B981;
            --success-light: #ECFDF5;
            --dark-color: #1F2937;
            --gray-color: #9CA3AF;
            --light-gray: #F9FAFB;
            --border-color: #E5E7EB;
            --danger-color: #EF4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
            color: #1F2937;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-container {
            width: 100%;
            max-width: 1000px;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .logo i {
            margin-right: 8px;
        }

        .help-link {
            color: var(--gray-color);
            text-decoration: none;
            font-size: 0.875rem;
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
        }

        .left-panel {
            padding: 40px;
            background-color: var(--primary-light);
        }

        .illustration {
            width: 100%;
            height: auto;
        }

        .panel-title {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .panel-text {
            color: #6B7280;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .form-container {
            padding: 40px;
        }

        .create-account {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .welcome-text {
            color: #6B7280;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-check {
            margin-bottom: 1.5rem;
        }

        .btn-sign-up {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 12px 0;
            border-radius: 8px;
            width: 100%;
            border: none;
            margin-bottom: 1.5rem;
        }

        .btn-sign-up:hover {
            background-color: #1D4ED8;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: var(--border-color);
        }

        .divider-text {
            padding: 0 1rem;
            color: var(--gray-color);
            font-size: 0.875rem;
        }

        .social-signup-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 0;
            border-radius: 8px;
            width: 100%;
            border: 1px solid var(--border-color);
            background-color: white;
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .social-icon {
            margin-right: 12px;
        }

        .google-icon {
            color: #EA4335;
        }

        .microsoft-icon {
            color: #00a4ef;
        }

        .already-account {
            text-align: center;
            color: #6B7280;
            font-size: 0.875rem;
        }

        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .error-text {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <a href="#" class="help-link">Need Help?</a>
    
    <div class="signup-container">
        <div class="row g-0">
            <!-- Left Panel -->
            <div class="col-md-5 left-panel">
                <div class="logo">
                    <i class="bi bi-chat-square-text"></i> DebateSkills
                </div>
                <img src="https://static.vecteezy.com/system/resources/previews/006/846/802/original/business-colleagues-debate-cartoon-illustration-people-sitting-at-table-and-discussing-ideas-brainstorming-business-meeting-teamwork-cooperation-collaboration-vector.jpg" alt="Debate Illustration" class="illustration">
                <h1 class="panel-title mt-4">Join Our Debating Community</h1>
                <p class="panel-text">Create an account to access courses, practice with other debaters, and track your progress as you enhance your skills.</p>
            </div>

            <!-- Right Panel (Sign Up Form) -->
            <div class="col-md-7 form-container">
                <h1 class="create-account">Create Account</h1>
                <p class="welcome-text">Start your journey to becoming a better debater</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" id="firstName" name="firstName" placeholder="Enter your first name" value="<?php echo $first_name; ?>">
                                <?php if(!empty($first_name_err)) { echo '<div class="error-text">' . $first_name_err . '</div>'; } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" id="lastName" name="lastName" placeholder="Enter your