<!-- Home page can not be accessed by anyone because it is a private page and User requires login credentials to enter in the home page.  -->
<?php
require_once("configuration.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
$s = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM students WHERE email = '".$_SESSION['email']."'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./frontEnd/style.css" />
    <title><?php echo $s['name'];?></title>
</head>
<body>
    <div class="container">
    <?php require("banner.php");?>
        <div id="form_container">
            <h3>Welcome <?php echo $s['name']; if($s['user_type'] == 1){echo " [ADMIN]";}?></h3>
            <img src="profile_pictures/<?php echo $s['picture'];?>" alt="profile_picture" style="width: 100px; height: 100px" />
            </br>
            </br>
            <input type="button" value="My Profile" onClick="window.location='profile.php'">
            <?php
            if($s['user_type'] == 1)
            {
            ?>
            <input type="button" value="Manage Students" onClick="window.location='manageStudents.php'">
            <?php
            }
            ?>
            <input type="button" value="Change Password" onClick="window.location='changePassword.php'">
            <?php
            if($s['user_type'] == 0)
            {
            ?>
            <input type="button" value="Delete Account" onClick="window.location='deleteAccount.php'">
            <?php
            }
            ?>
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>