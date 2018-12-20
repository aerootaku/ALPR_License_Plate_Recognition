<?php
include 'controller/connect.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $password = md5($_POST['newpassword']);
    $repassword = $_POST['repassword'];

    if ($password != '' || $repassword != '') // check if the password field is empty
    {
        if ($password == $repassword) { // compare password 1 = to password 2
            $query = ("UPDATE tbl_users SET password='$password' where id='$id'");


            echo "<script> alert('Password has successfuly changed'); </script>";
            echo " <script>window.location = 'dashboard.php?page'</script>";
        } else {

            echo "<script>alert('Password not match')</script>";
            echo " <script>window.location = 'pw-updatepassword.php?id=$xid'</script>";
        }
    }

}

if (!mysql_query($query, $con)) {
    die('error: ' . mysql_error());
}

?>
<?php

mysql_close($con);

?>
