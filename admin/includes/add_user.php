<?php

    global $connection;    
    
    if ( isset( $_POST['add_user']) ) {              
        $user_username = mysqli_escape_string($connection, $_POST['user_username']);
        $user_password = mysqli_escape_string($connection, $_POST['user_password']);
        $user_firstname = mysqli_escape_string($connection, $_POST['user_firstname']);
        $user_lastname = mysqli_escape_string($connection, $_POST['user_lastname']);
        $user_email = mysqli_escape_string($connection, $_POST['user_email']);
        $user_role = mysqli_escape_string($connection, $_POST['user_role']);                
        
        $user_img = $_FILES['user_img']['name'];
        if (!empty($user_img)) {
            $imgTempLocation = $_FILES['user_img']['tmp_name'];       
            move_uploaded_file($imgTempLocation, '../images/' . $user_img);   
        }

        if ( strlen($user_username) > 0 &&
            strlen($user_password) > 0 &&
            strlen($user_firstname) > 0 &&
            strlen($user_lastname) > 0 &&
            strlen($user_email) > 0 ) {           
            
            $query = "INSERT INTO users(user_username, user_password, user_firstname, user_lastname, user_email, user_role, user_img) ";
            $query .= "VALUES ('$user_username', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_role', '$user_img')";

            check_query($query);
            
            header('Location: users.php'); 

        } else {
            echo 'Please enter required content.<br />';
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" class="form-control" name="user_username">
    </div>    

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>    

    <div class="form-group">
        <label for="post_tags">First name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>     

    <div class="form-group">
        <label for="post_tags">Last name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_img">Avatar</label>       
        <input type="file" class="form-control" name="user_img">
    </div> 

    <div class="form-group">
        <label for="post_content">Role</label>
        <select class="form-control" name="user_role">            
            <option value="admin">Admin</option>
            <option value="user" selected="true">User</option>                   
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Add user" />
    </div>
</form>
