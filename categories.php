<?php
    if(isset($_GET['cat_id'])) {
        $the_cat_id = $_GET['cat_id'];
    }
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>  

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                <?php 
                    global $connection;
                    $queryPosts = "SELECT * FROM posts WHERE post_category_id = $the_cat_id AND post_status = 'published'";
                    $postsResult = mysqli_query($connection, $queryPosts);
                    $count = mysqli_num_rows($postsResult);

                    if ($count > 0) {

                    while( $row = mysqli_fetch_assoc($postsResult) ) {
                        $postId = $row['post_id'];
                        $postCategoryId = $row['post_category_id'];
                        $postTitle = $row['post_title'];
                        $postAuthor = $row['post_author'];
                        $postDate = $row['post_date'];
                        $postImg = $row['post_img'];
                        $postContent = substr($row['post_content'],0,100);
                        $postTags = $row['post_tags'];
                        $postCommentCount = $row['post_comment_count'];
                        $postStatus = $row['post_status'];
                    ?>

                    <h2>
                        <a href="post.php?id=<?php echo $postId ?>"><?php echo $postTitle ?></a>
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

                <?php }                    
                    } else {
                        echo 'No posts found';
                    }
                ?>
                
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <?php include 'includes/sidebar.php' ?>

        <hr>
<?php include 'includes/footer.php' ?>