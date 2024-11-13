<?php
require "connectDB.php";

$createAcc = FALSE;
$errorPassword = "";
$errorConfirmPassword = "";
$errorMobile_no = "";

if (isset($_POST["signUp"])) {
    $username = $_POST["username"];
    $mobile_no = $_POST["mobileNo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $c_password = $_POST["cpassword"];
    $gender = $_POST["gender"];

    
    if (empty($mobile_no)) {
        $errorMobile_no = "* Mobile number must be provided.";
    } elseif (strlen($mobile_no) != 11) {
        $errorMobile_no = "* Number must be 11 digits.";
    }

    if (empty($password)) {
        $errorPassword = "*Please fill the password field!";
    } elseif ($password !== $c_password) {
        $errorConfirmPassword = "*Write the same password to confirm.";
    }

   
    if (empty($errorMobile_no) && empty($errorPassword) && empty($errorConfirmPassword)) {
        $sql = "INSERT INTO `fitness-trainer-user` (Username, MobileNo, Email, Password, Gender) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("sssss", $username, $mobile_no, $email, $password, $gender);

        if ($stmt->execute()) {
            $createAcc = TRUE;
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/CSS.css">
</head>
</head>
<body>
    <div class="main">
        <div class="signin">
            <form action="" method="post">
                <label id="sign-up" for="chk">Sign Up</label>
                <input class="input-field" type="text" name="username" placeholder="User name" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                
                <input class="input-field" type="text" name="mobileNo" placeholder="Mobile number" value="<?php echo isset($mobile_no) ? htmlspecialchars($mobile_no) : ''; ?>" required>
                <span><?php echo $errorMobile_no; ?></span>
                
                <input class="input-field" type="email" name="email" placeholder="Email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                
                <span><?php echo $errorPassword; ?></span>
                <input class="input-field" type="password" name="password" placeholder="Password" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>">
                
                <span><?php echo $errorConfirmPassword; ?></span>
                <input class="input-field" type="password" name="cpassword" placeholder="Confirm Password" value="<?php echo isset($c_password) ? htmlspecialchars($c_password) : ''; ?>">
                
                <div class="radio-container">
                    <input class="input-radio" type="radio" name="gender" id="male" value="Male" <?php echo isset($gender) && $gender == "Male" ? 'checked' : ''; ?> required>
                    <label for="male">Male</label>
                    <input class="input-radio" type="radio" name="gender" id="female" value="Female" <?php echo isset($gender) && $gender == "Female" ? 'checked' : ''; ?>>
                    <label for="female">Female</label>
                </div>
                
                <input class="signup-button" type="submit" name="signUp" value="Sign Up">
            </form>
            
            <?php
            if ($createAcc) {
                echo "<strong style='margin-left: 80px; color: white;'>Sign Up Successfully!</strong>";
            }
            ?>
        </div>
    </div>
</body>
</html>
