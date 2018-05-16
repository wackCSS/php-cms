<?php

    global $connection;

    if (isset($_GET['id'])) {
        $the_edit_user_id = $_GET['id'];            
        $query = "SELECT * FROM users ";           
        $query .= "WHERE user_id = {$the_edit_user_id}";        
        check_query($query);
        
        $editUserQuery = mysqli_query($connection, $query);        
        
        while( $rows = mysqli_fetch_assoc($editUserQuery) ) {
            $userId = $rows['user_id'];
            $userUsername = $rows['user_username'];
            $userPassword = $rows['user_password'];
            $userFirstName = $rows['user_firstname'];
            $userLastName = $rows['user_lastname'];
            $userEmail = $rows['user_email'];
            $userImg = !empty($rows['user_img']) ? $rows['user_img'] : '';
            $userRole = $rows['user_role'];
        }
    }
    
    if ( isset( $_POST['update_user']) ) {
        $user_id = $_POST['user_id'];        
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
            
            $query = "UPDATE users SET ";            
            $query .= "user_username = '{$user_username}', ";
            $query .= "user_password = '{$user_password}', ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_email = '{$user_email}', ";
            if (!empty($user_img)) {
                $query .= "user_img = '{$user_img}', ";
            }
            $query .= "user_role = '{$user_role}' ";                               
            $query .= "WHERE user_id = {$user_id}"; 

            check_query($query);
            
            header('Location: users.php'); 

        } else {
            echo 'Please enter required content.<br />';
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">          
    
    <div class="form-group">
        <label for="post_author">User ID</label>
        <input type="text" class="form-control hidden" name="user_id" value="<?php echo $userId ?>" readonly>
    </div>

    <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" class="form-control" name="user_username" value="<?php echo $userUsername ?>">
    </div>    

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="text" class="form-control" name="user_password" value="<?php echo $userPassword ?>">
    </div>    

    <div class="form-group">
        <label for="post_tags">First name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $userFirstName ?>">
    </div>     

    <div class="form-group">
        <label for="post_tags">Last name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $userLastName?>">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" class="form-control" name="user_email" value="<?php echo $userEmail ?>">
    </div>

    <div class="form-group">
        <label for="post_img">Avatar</label>
        <div>
            <img height="100" src="../images/<?php echo $userImg ?>" alt="image">
        </div>
        <input type="file" class="form-control" name="user_img">
    </div> 

    <div class="form-group">
        <label for="post_content">Role</label>
        <select class="form-control" name="user_role">
            <?php 
                $isAdmin = ($userRole == 'admin') ? 'selected="selected"' : '';
                echo '<option value="admin" ' . $isPublished .'>Admin</option>';
                echo '<option value="user"' . $isPublished . '>User</option>'
            ?>        
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Edit user" />
    </div>
</form>
