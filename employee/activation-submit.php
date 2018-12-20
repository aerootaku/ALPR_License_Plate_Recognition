<?php
//create connection
include '../controller/connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $activate_string = "Activate";
    $sqlusers = "update tbl_users_info set stats='$activate_string' where id = '$id'";
    if (!mysql_query($sqlusers,$con))
    {
        die('error: ' . mysql_error());
    }
}

?>
<script> alert('User Successfully Activated'); </script>
<script>window.location='user-list.php'</script>