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
            <h3><?php echo $s['name'];?>'s Profile</h3>
            <img src="profile_pictures/<?php echo $s['picture'];?>" alt="profile_picture" style="width: 100px; height: 100px" />
            </br>
            </br>
            <table style="border: 0;" cellpadding="5" cellspacing="5">
                <tr>
                    <td class="labels">Name:</td>
                    <td class="labels"><?php echo $s['name'];?></td>
                </tr>
                <tr>
                    <td class="labels">Date of Birth:</td>
                    <td class="labels"><?php echo $s['dob'];?></td>
                </tr>
                <tr>
                    <td class="labels">E-mail ID:</td>
                    <td class="labels"><?php echo $s['email'];?></td>
                </tr>
                <tr>
                    <td class="labels">Address:</td>
                    <td class="labels"><?php echo $s['address'];?></td>
                </tr>
                <tr>
                    <td class="labels">Registration Date:</td>
                    <td class="labels"><?php echo $s['date'];?></td>
                </tr>
            </table>
            <input type="button" value="EDIT" onClick="window.location='edit.php'">
            <input type="button" value="HOME" onClick="window.location='home.php'">
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>