<?php

require_once('functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
  <div class="container">
    <div class="box form-box">

        <?php

        include("php/config.php");

        $nameErr = $emailErr = $ageErr = "";
        $name = $email = $age = $password = "";

        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if(isset($_POST['submit'])) {
            $name = sanitize_input($_POST['name']);
            $email = sanitize_input($_POST['email']);
            $age = sanitize_input($_POST['age']);
            $password = sanitize_input($_POST['password']);

            // Validate the name field
            if (empty($name)) {
                $nameErr = "Username is required";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed in username";
            }

            // Validate the email field
            if (empty($email)) {
                $emailErr = "Email is required";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }

             // Validate the age field
            if (empty($age)) {
                $ageErr = "Age is required";
            } elseif (!is_numeric($age) || $age <= 0) {
                $ageErr = "Age must be a positive integer";
            }

            if (empty($nameErr) && empty($emailErr) && empty($ageErr)) {

              $randomPassword = generateRandomPassword(10);

              $insert_query = "INSERT INTO users(Name, Email, Age, Password) VALUES('$name','$email','$age','$randomPassword')";
              $insert_result = mysqli_query($con, $insert_query);
          }
          if($insert_result){
            echo "<div class='message'>
            <p>Registration successful! Your random password is: $randomPassword</p>
            </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
        }
    }else{
        
        ?>

        <header>Register</header>
        <form action="" method="post">
            <div class="field input">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" autocomplete="off" required>
                <span class="error"><?php echo $nameErr; ?></span>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" autocomplete="off" required>
                <span class="error"><?php echo $emailErr; ?></span>
            </div>

            <div class="field input">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" autocomplete="off" required>
                <span class="error"><?php echo $ageErr; ?></span>
            </div>
            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register" required>
            </div>
            <div class="links">
                Already a member? <a href="index.php">Sign In</a>
            </div>
        </form>
    </div>
<?php } ?>
</div>
</body>
</html>
