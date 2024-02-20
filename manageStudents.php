<!-- Home page can not be accessed by anyone because it is a private page and User requires login credentials to enter in the home page.  -->
<?php
require_once("configuration.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
$s = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM students WHERE email = '".$_SESSION['email']."'"));
if($s['user_type'] != 1)
{
    header("location:home.php");
}
if(!empty($_GET['msg']))
{
    if($_GET['msg'] == sha1('true'))
    {
        ?>
            <script>
                alert('Successfully Deleted');
            </script>
            <?php }
            elseif($_GET['msg'] == sha1('false'))
            {
                ?>
            <script>
                alert('Error! Please try again');
            </script>
            <?php }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./frontEnd/style.css" />
    <title><?php echo $s['name'];?></title>
    <style type="text/css">
        table, tr, td, th
        {
            border: 2px solid #99f2c8;
            padding: 5px;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php require("banner.php");?>
        <div id="form_container">
            <h3>Welcome <?php echo $s['name']; if($s['user_type'] == 1){echo " [ADMIN]";}?></h3>
            <img src="profile_pictures/<?php echo $s['picture'];?>" alt="profile_picture" style="width: 100px; height: 100px" />
            </br>
            </br>
            <table cellpadding="5" cellspacing="5" class="studentData">
                <tr>
                    <th>Sr.No.</th>
                    <th>NAME</th>
                    <th>DOB</th>
                    <th>ADDRESS</th>
                    <th>EMAIL</th>
                    <th>PICTURE</th>
                    <th>REGISTRATION TIME &amp; DATE</th>
                    <th>DELETE ACCOUNT</th>
                </tr>
                <?php
                $a = mysqli_query($al, "SELECT * FROM students WHERE user_type = '0' ORDER BY id DESC");
                $sr = 1;
                while($pr = mysqli_fetch_array($a))
                {
                ?>
                <tr>
                    <td><?php echo $sr;$sr++;?></td>
                    <td><?php echo $pr['name'];?></td>
                    <td><?php echo $pr['dob'];?></td>
                    <td><?php echo $pr['address'];?></td>
                    <td><?php echo $pr['email'];?></td>
                    <td><img src="profile_pictures/<?php echo $pr['picture'];?>" alt="student_pic" height="50px" width="50px"></td>
                    <td><?php echo $pr['time']." ".$pr['date'];?></td>
                    <td><a href="delete.php?key=<?php echo $pr['hash_key'];?>" onclick="return confirm('Are you sure?');" class="footerstyle">DELETE</a></td>
                </tr>
                <?php } ?>
            </table>
            </br>
            </br>
            <input type="button" value="HOME" onClick="window.location='home.php'">
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>