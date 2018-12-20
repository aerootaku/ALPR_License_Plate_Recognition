<?php
//create connection
include 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlusers = "delete from tbl_users_info where id = '$id'";
    if (!mysql_query($sql,$con))
    {
        die('error: ' . mysql_error());
    }

    $sqllogin = "delete from tbl_login_users where users_infoID = '$id'";
    if (!mysql_query($sqllogin,$con))
    {
        die('error: ' . mysql_error());
    }
}

?>
<script> alert('User successfully deleted'); </script>
<script>window.location='admin-users.php?page'</script>
