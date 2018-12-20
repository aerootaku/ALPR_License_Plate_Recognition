<?php
include '../controller/connect.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($password != '' || $name != '') // check if the password field is empty
    {

     // compare password 1 = to password 2
            $query = ("UPDATE tbl_admin_accounts SET name='$name', username='$username', password='$password' where id='$id'");

            echo "<script> alert('Password has successfuly changed'); </script>";
            echo " <script>window.location = 'dashboard.php?page'</script>";
        }
         else {

            echo "<script>alert('Password not match')</script>";
            echo " <script>window.location = 'pw-updatepassword.php?id=$xid'</script>";
        }
    



if (!mysql_query($query, $con)) {
    die('error: ' . mysql_error());
}
}
?>
<?php

mysql_close($con);

?>
