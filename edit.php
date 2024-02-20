<!-- Home page can not be accessed by anyone because it is a private page and User requires login credentials to enter in the home page.  -->
<?php
require_once("configuration.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
if(!empty($_POST))
{
    $sql = mysqli_query($al, "UPDATE students SET name = '".$_POST['name']."', address = '".$_POST['address']."', dob = '".$_POST['dob']."' WHERE email = '".$_SESSION['email']."' ");
    if($sql)
    {
        $msg = "Successfully updated";
    }
    else
    {
        $msg = "Update error";
    }
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
            <h3>Edit Account Information</h3>
            <img src="profile_pictures/<?php echo $s['picture'];?>" alt="profile_picture" style="width: 100px; height: 100px" />
            </br>
            </br>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <table style="border: 0" cellpadding="5" cellspacing="5">
                <tr>
                    <td class="labels">Name:</td>
                    <td class="labels"><input type="text" name="name" value="<?php echo $s['name'];?>" size="20" required></td>
                </tr>
                <tr>
                    <td class="labels">Date of Birth:</td>
                    <td class="labels"><input type="date" name="dob" size="20" required></td>
                </tr>
                <tr>
                    <td class="labels">E-mail ID:</td>
                    <td class="labels"><input type="email" value="<?php echo $s['email'];?>" size="30" readonly disabled></td>
                </tr>
                <tr>
                    <td class="labels">Address:</td>
                    <td class="labels"><textarea name="address" placeholder="Enter Permanent Address" required><?php echo $s['address'];?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="UPDATE" onClick="return confirm('Are you sure?');"/></td>
                </tr>
            </table>
            </form>
            </br>
            </br>
            <input type="button" value="BACK" onClick="window.location='profile.php'">
            <input type="button" value="HOME" onClick="window.location='home.php'">
            </br>
            </br>
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>