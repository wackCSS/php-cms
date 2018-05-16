<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>ID</th>
        <th>Article name</th>        
        <th>Author</th>
        <th>Email</th>
        <th>Content</th>
        <th>date</th>
        <th>Status</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>

<?php
    global $connection;
    
    delete_comment();
    approve_comment();
    unapprove_comment();
    
    $queryComments = "SELECT * FROM comments";
    $CommentsResults = mysqli_query($connection, $queryComments);

    while( $rows = mysqli_fetch_assoc($CommentsResults) ) {
        $commentId = $rows['comment_id'];
        $commentPostId = $rows['comment_post_id'];        
        $commentAuthor = $rows['comment_author'];
        $commentEmail = $rows['comment_email'];
        $commentContent = $rows['comment_content'];
        $commentStatus = $rows['comment_status'];
        $commentDate = $rows['comment_date'];

        echo '<tr>';
        echo    '<td>' . $commentId . '</td>';
        
        $queryPostTitle = "SELECT * FROM posts WHERE post_id = $commentPostId";
        $postTitleResults = mysqli_query($connection, $queryPostTitle);
        
        while( $rows = mysqli_fetch_assoc($postTitleResults) ) {            
            $postTitle = isset($rows['post_title']) ? $rows['post_title'] : '';
            
            echo '<td><a href="../post.php?id=' . $commentPostId .'">' . $postTitle . '</a></td>';
        }

        echo    '<td>' . $commentAuthor . '</td>';
        echo    '<td>' . $commentEmail . '</td>';
        echo    '<td>' . $commentContent . '</td>';
        echo    '<td>' . $commentDate . '</td>';
        echo    '<td>' . $commentStatus . '</td>';
        echo    '<td><a href="comments.php?approve=' . $commentId . '">Approve</a></td>';
        echo    '<td><a href="comments.php?unapprove=' . $commentId . '">Unapprove</a></td>';
        echo    '<td><a href="comments.php?source=edit_comment&id=' . $commentId . '">Edit</a></td>';
        echo    '<td><a href="comments.php?delete=' . $commentId . '">Delete</a></td>';
        echo '</tr>';                             
    }

    echo '</tbody>';
    echo '</table>'; 
?>         