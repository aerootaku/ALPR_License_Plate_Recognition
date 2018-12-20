<?php
//create connection
include '../controller/connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlusers = "delete from tbl_admin_accounts where id = '$id'";
    if (!mysql_query($sqlusers,$con))
    {
        die('error: ' . mysql_error());
    }
}

?>
<script> alert('User successfully deleted'); </script>
<script>window.location='users-admin.php'</script>