<?php
include '../controller/connect.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $oldpassword = md5($_POST['oldpassword']);
    $password = ($_POST['newpassword']);
    $repassword = $_POST['repassword'];

    $sql=("SELECT * FROM tbl_users WHERE id='$id' AND password='$oldpassword'");
    $data=mysqli_query($conn,$sql);   
    if($row=mysqli_fetch_array($data)){ 
 if ($password != '' || $repassword != '') // check if the password field is empty
    {
        if ($password == $repassword) { // compare password 1 = to password 2
            $password =md5($password);
            $query = ("UPDATE tbl_users SET password='$password' where id='$id'");

            echo "<script> alert('Password has successfuly changed'); </script>";
            echo " <script>window.location = 'dashboard.php?page'</script>";
        } else {

            echo "<script>alert('Password not match')</script>";
            echo " <script>window.location = 'pw-updatepassword.php?id=$id'</script>";
        }
    }

} else {

 echo "<script>alert('Old Password not match')</script>";
            echo " <script>window.location = 'pw-updatepassword.php?id=$id'</script>";

}

   

}

if (!mysql_query($query, $con)) {
    die('error: ' . mysql_error());
}

?>
<?php

mysql_close($con);

?>
