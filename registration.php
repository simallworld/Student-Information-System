<?php
require_once("configuration.php"); //session started
if(!empty($_POST))
{
    $hash_key = sha1(microtime());
    if($_FILES["dp"]["error"] > 0)
    {
        $msg = "File upload error";
    }
    else
    {
        $file_name = $_FILES["dp"]["name"];
        $upload_dir = "profile_pictures";
        $extension = end(explode(".",$file_name));
        $file_id = md5($_POST['email']).".".$extension;
        if($extension == 'webp' || $extension == 'WEBP' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'jpg' || $extension == 'JPG' || $extension == 'gif' || $extension == 'GIF' || $extension == 'png' || $extension == 'PNG' || $extension == 'bmp' || $extension == 'BMP')
        {
            $sql = mysqli_query($al, "INSERT INTO students(user_type,hash_key,name,dob,address,email,password,picture,time,date,agent,ip) VALUES('0','".$hash_key."','".mysqli_real_escape_string($al,$_POST['name'])."','".mysqli_real_escape_string($al,$_POST['dob'])."','".mysqli_real_escape_string($al,$_POST['address'])."','".mysqli_real_escape_string($al,$_POST['email'])."','".mysqli_real_escape_string($al,sha1($_POST['p1']))."','".$file_id."','".date('h:i A')."','".date('d-m-Y')."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."')");
            // SQL INJECTION PROTECTION
            // mysqli_real_escape_string($al,$_POST['email'])

            if($sql)
            {
                move_uploaded_file($_FILES["dp"]["tmp_name"],$upload_dir."/".$file_id);
                $msg = "Successfully registered";
            }
            else
            {
                $msg = "Account already exists";
            }
        }
        else
        {
            $msg = "Wrong file uploaded";
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
    <title>Student Information System | Registration</title>
    <script type="text/javacript">
        function passwords()
        {
            if(document.getElementById(p1).value == document.getElementById(p2).value)
            {
                return true;
            }else{
                alert('Password do not matched');
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <?php require("banner.php");?>
        <div id="form_container">
            <h3>New Registration</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" onsubmit="return passwords()">
                <table cellpadding="5" cellspacing="5">
                    <tr>
                        <td colspan="2" style="color:red"><?php if(isset($msg)) {echo $msg; }?></td>
                    </tr>
                    <tr>
                        <td class="labels">Name:</td>
                        <td><input type="text" name="name" placeholder="Enter your Name" required></td>
                    </tr>
                    <tr>
                        <td class="labels">DOB:</td>
                        <td><input type="date" name="dob" required></td>
                    </tr>
                    <tr>
                        <td class="labels">E-mail:</td>
                        <td><input type="email" name="email" placeholder="Enter your E-mail" required></td>
                    </tr>
                    <tr>
                        <td class="labels">Password:</td>
                        <td><input type="password" name="p1" placeholder="Enter Password" required id="p1"></td>
                    </tr>
                    <tr>
                        <td class="labels">Confirm password:</td>
                        <td><input type="password" name="p2" placeholder="Confirm password" required id="p2"></td>
                    </tr>
                    <tr>
                        <td class="labels">Address:</td>
                        <td><textarea name="address" placeholder="Enter Address" required></textarea></td>
                    </tr>
                    <tr>
                        <td class="labels">Profile Picture:</td>
                        <td><input type="file" name="dp" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Register" onclick="return confirm('Are you sure?');"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="register_here">Already registered? <a href="index.php" class="link">Login here!</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>