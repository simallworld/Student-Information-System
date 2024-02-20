<!-- Home page can not be accessed by anyone because it is a private page and User requires login credentials to enter in the home page.  -->
<?php
require_once("configuration.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
$s = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM students WHERE email = '".$_SESSION['email']."'"));
if(!empty($_POST))
{
    if(sha1($_POST['current_password']) == $s['password'])
        {
            if($_POST['new_password'] == $_POST['confirm_password'])
                {
                    $sql = mysqli_query($al, "UPDATE students SET password = '".sha1($_POST['new_password'])."' WHERE email = '".$_SESSION['email']."'");
                    if($sql)
                    {
                        $msg = "Successfully updated";
                    }
                    else
                    {
                        $msg = "Failed! Please try again";
                    }
                }
                else
                {
                    $msg = "New password wasn't same";
                }
        }
        else
        {
            $msg = "Incorrect current password";
        }
}
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
            <h3>Change Password</h3>
            <img src="profile_pictures/<?php echo $s['picture'];?>" alt="profile_picture" style="width: 100px; height: 100px" />
            </br>
            </br>
            
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <table style="border: 0" cellpadding="5" cellspacing="5">
                <tr>
                    <td colspan="2" style="color:red"><?php if(isset($msg)) {echo $msg; }?></td>
                </tr>
                <tr>
                    <td class="labels">Current Password:</td>
                    <td><input type="password" name="current_password" size="30" placeholder="Enter Current Password"/></td>
                </tr>
                <tr>
                    <td class="labels">New Password:</td>
                    <td><input type="password" name="new_password" size="30" placeholder="Enter New Password"/></td>
                </tr>
                <tr>
                    <td class="labels">Confirm Password:</td>
                    <td><input type="password" name="confirm_password" size="30" placeholder="Confirm New Password"/></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Change Password"/></td>
                </tr>
            </table>
            </form>
            <input type="button" value="HOME" onClick="window.location='home.php'">
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>