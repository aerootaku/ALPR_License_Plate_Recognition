<?php
//create connection
include '../controller/connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $fee = 0;
    $sqlusers = "update tbl_violations set vstatus='Paid', fee='$fee' where id = '$id'";
    if (!mysql_query($sqlusers,$con))
    {
        die('error: ' . mysql_error());
    }
}

?>
<script> alert('Violation Successfully Deleted'); </script>
<script>window.location='dashboard.php'</script>