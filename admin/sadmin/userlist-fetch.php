<?php


//command for fetching users_info table
$sql = "SELECT * from tbl_users_info";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $profile = $row['profile'];
                $firstname=$row['firstname'];
                $middlename=$row['middlename'];
                $lastname=$row['lastname'];
                $age=$row['age'];
                $gender=$row['gender'];
                $birthday=$row['birthday'];
                $contact=$row['contact'];
                $email=$row['email'];
                $address=$row['address'];
                $platenumber=$row['platenumber'];
               }

               //don't forget to add the } to the end of the line to stop the row fetching
                

?>