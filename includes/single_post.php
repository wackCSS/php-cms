
<?php 
    global $connection;
    $queryPosts = "SELECT * FROM posts";
    $postsResult = mysqli_query($connection, $queryPosts);

    while( $row = mysqli_fetch_assoc($postsResult) ) {
        $postId = $row['post_id'];
        $postCategoryId = $row['post_category_id'];
        $postTitle = $row['post_title'];
        $postAuthor = $row['post_author'];
        $postDate = $row['post_date'];
        $postImg = $row['post_img'];
        $postContent = $row['post_content'];
        $postTags = $row['post_tags'];
        $postCommentCount = $row['post_comment_count'];
        $postStatus = $row['post_status'];
    ?>

    <h2>
        <a href="#"><?php echo $postTitle ?></a>
    </h2>
    <p class="lead">
        by <a href="index.php"><?php echo $postAuthor ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
    <hr>
    <img class="img-responsive" src="images/<?php echo $postImg ?>" alt="image">
    <hr>
    <p><?php echo $postContent ?></p>
    <a class="btn btn-primary" href="posts/<?php echo $postId ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

    <hr>


    <?php }?>




