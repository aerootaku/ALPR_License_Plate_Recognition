<?php
//create connection
include '../controller/connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlusers = "delete from tbl_violations where id = '$id'";
    if (!mysql_query($sqlusers,$con))
    {
        die('error: ' . mysql_error());
    }
}

?>
<script> alert('Violation Successfully Deleted'); </script>
<script>window.location='dashboard.php'</script>