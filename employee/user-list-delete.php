<?php
//create connection
include '../controller/connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlusers = "delete from tbl_users_info where id = '$id'";
    if (!mysql_query($sqlusers,$con))
    {
        die('error: ' . mysql_error());
    }

    $sqllogin = "delete from tbl_users where id = '$id'";
    if (!mysql_query($sqllogin,$con))
    {
        die('error: ' . mysql_error());
    }
}

?>
<script> alert('User successfully deleted'); </script>
<script>window.location='user-list.php'</script>