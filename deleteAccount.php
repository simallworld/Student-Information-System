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
    if(sha1($_POST['pass']) == $s['password'])
    {
        $sql  =   mysqli_query($al, "DELETE FROM students WHERE email = '".$_SESSION['email']."'");
        if($sql)
        {
            header("location:logout.php");
        }
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
            <h3>Delete Account</h3>
            <img src="profile_pictures/<?php echo $s['picture'];?>" alt="profile_picture" style="width: 100px; height: 100px" />
            </br>
            </br>
            <form method="post" action="<?echo $_SERVER['PHP_SELF'];?>">
                <table cellpadding="5" cellspacing="5">
                    <tr>
                        <td class="labels">Enter Password to Delete Account</td>
                        <td><input type="password" name="pass" size="30" placeholder="Enter Password" required/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="PERMANENT DELETE ACCOUNT" onclick="return confirm('Are you sure?');"/></td>
                    </tr>
                </table>
            </form>
            <input type="button" value="HOME" onClick="window.location='home.php'">
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>