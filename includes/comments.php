<?php
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
    }    

    global $connection;

    if (isset($_POST['create_comment'])) {
        $commentAuthor = mysqli_escape_string($connection, $_POST['comment_author']);
        $commentEmail = mysqli_escape_string($connection, $_POST['comment_email']);
        $commentContent = mysqli_escape_string($connection, $_POST['comment_content']);
        $commentPostId = $post_id;

        if ( strlen($commentAuthor) > 0 && 
            strlen($commentEmail) > 0 && 
            strlen($commentContent) > 0) {           
                
                $query = "INSERT INTO comments(comment_author, comment_email, comment_content, comment_date, comment_post_id) ";
                $query .= "VALUES ('$commentAuthor', '$commentEmail', '$commentContent', now(), {$post_id})";
                
                $result = mysqli_query($connection, $query);

                if(!$result) {
                    die('query failed' . mysqli_error($connection));
                } else {

                    $updateCommentQuery = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $commentPostId";
                    $updateCommentCount = mysqli_query($connection, $updateCommentQuery);
                    
                    echo '<p>Thanks for your comment. It has been passed to our moderators.</p>';
                }
        }
    }
?>
<!-- Blog Comments -->

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment</h4>
    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="comment_author">Name:</label>
            <input type="text" class="form-control" name="comment_author">
        </div>       
        <div class="form-group">
            <label for="comment_email">Email:</label>
            <input type="text" class="form-control" name="comment_email">
        </div>
        <div class="form-group">
        <label for="comment_content">Comment:</label>
            <textarea class="form-control" name="comment_content" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" type="submit" name="create_comment">Submit</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->
<?php 
    global $connection;

    $queryComments = "SELECT * FROM comments WHERE comment_post_id = $post_id";
    $CommentsResults = mysqli_query($connection, $queryComments);

    while( $rows = mysqli_fetch_assoc($CommentsResults) ) {
        $commentId = $rows['comment_id'];              
        $commentAuthor = $rows['comment_author'];
        $commentEmail = $rows['comment_email'];
        $commentContent = $rows['comment_content'];
        $commentDate = $rows['comment_date'];
        $showComment = ($rows['comment_status'] === 'approved') ? true : false;

        if ($showComment) {
            echo '<div class="media">';
            echo   '<a class="pull-left" href="#">';
            echo     '<img class="media-object" src="http://placehold.it/64x64" alt="">';
            echo   '</a>';
            echo   '<div class="media-body">';
            echo     '<h4 class="media-heading">' . $commentAuthor . ' ';
            echo       '<small>' . $commentDate . '</small>';
            echo     '</h4>';
            echo     $commentContent;
            echo   '</div>';
            echo '</div>';
        }
    }
?>
<!-- Comment -->
<!-- <div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
</div> -->

<!-- Comment 
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        <!-- Nested Comment 
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Nested Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>
        <!-- End Nested Comment
    </div>
</div> -->