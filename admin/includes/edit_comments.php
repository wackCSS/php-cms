<?php

    global $connection;

    if (isset($_GET['id'])) {
        $the_edit_comment_id = $_GET['id'];            
        $query = "SELECT * FROM comments ";           
        $query .= "WHERE comment_id = {$the_edit_comment_id}";        
        check_query($query);
        
        $editCommentQuery = mysqli_query($connection, $query);        
        
        while( $rows = mysqli_fetch_assoc($editCommentQuery) ) {
            $commentId = $rows['comment_id'];
            $commentPostId = $rows['comment_post_id'];        
            $commentAuthor = $rows['comment_author'];
            $commentEmail = $rows['comment_email'];
            $commentContent = $rows['comment_content'];
            $commentStatus = $rows['comment_status'];
            $commentDate = $rows['comment_date'];
        }
    }
    
    if ( isset( $_POST['update_comment']) ) {        
        $comment_content = mysqli_escape_string($connection, $_POST['comment_content']);
        $comment_status = mysqli_escape_string($connection, $_POST['comment_status']);
        if ( strlen($commentContent) > 0 ) {           
            
            $query = "UPDATE comments SET ";            
            $query .= "comment_content = '{$comment_content}', ";
            $query .= "comment_status = '{$comment_status}' ";
            $query .= "WHERE comment_id = {$the_edit_comment_id}"; 

            check_query($query);
            
            header('Location: comments.php'); 

        } else {
            echo 'Please enter some content for the comment.<br />';
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">          
    
    <div class="form-group">
        <label for="post_author">ID</label>
        <input type="text" class="form-control hidden" name="comment_id" value="<?php echo $commentId ?>" readonly>
    </div>

    <div class="form-group">
        <label for="post_status">Post ID</label>
        <input type="text" class="form-control" name="comment_post_id" value="<?php echo $commentPostId ?>" readonly>
    </div>    

    <div class="form-group">
        <label for="post_tags">Author Email</label>
        <input type="text" class="form-control" name="comment_email" value="<?php echo $commentEmail ?>" readonly>
    </div>    

    <div class="form-group">
        <label for="post_tags">Author Name</label>
        <input type="text" class="form-control" name="comment_author" value="<?php echo $commentAuthor ?>" readonly>
    </div>     

    <div class="form-group">
        <label for="post_tags">Date</label>
        <input type="text" class="form-control" name="comment_date" value="<?php echo $commentDate?>" readonly>
    </div>

    <div class="form-group">
        <label for="post_tags">Status</label>
        <input type="text" class="form-control" name="comment_status" value="<?php echo $commentStatus ?>">
    </div>

    <!-- <div class="form-group">
        <label for="post_img">Post img</label>
        <div>
            <img height="100" src="../images/<?php echo $postImg ?>" alt="image">
        </div>
        <input type="file" class="form-control" name="post_img">
    </div>  -->

    <div class="form-group">
        <label for="post_content">Post content</label>
        <textarea class="form-control" name="comment_content" cols="30" rows="5"><?php echo $commentContent ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_comment" value="Edit comment" />
    </div>
</form>
