<!-- Index page can be accessed by anyone because, it is a public page. -->
<?php
require_once("configuration.php");
if(isset($_SESSION['email']))
{
    header("location:home.php");
}
if(!empty($_POST))
{
    $email = mysqli_real_escape_string($al, $_POST['email']);
    $password =mysqli_real_escape_string($al, sha1($_POST['password']));
    $sql = mysqli_query($al, "SELECT * FROM students WHERE email = '".$email."' AND password = '".$password."'");
    if(mysqli_num_rows($sql) == 1)
    {
        $_SESSION['email'] = $_POST['email'];
        header("location:home.php");
    }else
    {
        $msg = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./frontEnd/style.css" />
    <title>Student Information System</title>
</head>
<body>
    <div class="container">
    <?php require("banner.php");?>
        <div id="form_container">
            <h3>Student/Admin Login</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table cellpadding="5" cellspacing="5">
                    <tr>
                        <td colspan="2" style="color:red"><?php if(isset($msg)) {echo $msg; }?></td>
                    </tr>
                    <tr>
                        <td class="labels">E-mail:</td>
                        <td><input type="email" name="email" placeholder="Enter your E-mail" required></td>
                    </tr>
                    <tr>
                        <td class="labels">Password:</td>
                        <td><input type="password" name="password" placeholder="Enter your Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Login"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="register_here">New User? <a href="registration.php" class="link">Register here!</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div id="footer">&copy; Copyright 2024 | Designed &amp; developed by SIMALLWORLD</div>
</body>
</html>