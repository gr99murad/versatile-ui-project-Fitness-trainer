<?php
    require "connectDB.php";

    $login = FALSE;
    $failed = FALSE;
    if(isset($_POST["signIn"])){  
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        
        $stmt = $conn->prepare("SELECT * FROM `fitness-trainer-user` WHERE Username = ? AND Password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $num = $result->num_rows;

        if($num > 0){
            $login = TRUE;
            
            header("Location: home.html");
            exit();
        } else {
            $failed = TRUE;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link rel="stylesheet" href="styles/CSS.css">
</head>

<body>

	<div class="main">

		<div class="signup">
        <form action="" method="post">
    <label id="sign-up" for="chk">Login</label>
    
    <input class="input-field" type="text" name="username" placeholder="User name" 
           value="<?php echo (isset($username)) ? $username : ''; ?>"> <!-- name="username" -->
        
            <input class="input-field" type="password" name="password" placeholder="Password"
                value="<?php echo (isset($password)) ? $password : ''; ?>">
        
            <input class="signup-button" type="submit" name="signIn" value="Login"> <!-- name="signIn" -->
        </form>

           

            <?php
            if ($login) {
                echo "<strong style='margin-left: 80px; color: red;'>Login Successfully!</strong>";
            }
            if ($failed) {
                echo "<strong style='margin-left: 80px; color: red;'>Please Sign up your account</strong>";
            }
            ?>

		</div>

	</div>

</body>
</html>