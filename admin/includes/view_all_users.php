<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
</thead>
<tbody>

<?php
    global $connection;
        
    $queryUsers = "SELECT * FROM users";
    $usersResults = mysqli_query($connection, $queryUsers);

    while( $rows = mysqli_fetch_assoc($usersResults) ) {
        $userId = $rows['user_id'];
        $userUsername = $rows['user_username'];
        $userPassword = $rows['user_password'];
        $userFirstName = $rows['user_firstname'];
        $userLastName = $rows['user_lastname'];
        $userEmail = $rows['user_email'];
        $userImg = $rows['user_img'];
        $userRole = $rows['user_role'];

        echo '<tr>';
        echo    '<td>' . $userId . '</td>';
        echo    '<td>' . $userUsername . '</td>';
        echo    '<td>' . $userPassword . '</td>';
        echo    '<td>' . $userFirstName . '</td>';
        echo    '<td>' . $userLastName . '</td>';
        echo    '<td>' . $userEmail . '</td>';
        echo    '<td><img height="100" src="../images/' . $userImg . '" alt="image"></td>';        
        echo    '<td>' . $userRole . '</td>';
        echo    '<td><a href="users.php?source=edit_user&id=' . $userId . '">Edit</a></td>';
        echo    '<td><a href="users.php?delete_user=' . $userId . '">Delete</a></td>';
        echo '</tr>';                             
        
    }

?>