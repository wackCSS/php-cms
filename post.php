<?php
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
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
                    $queryPosts = "SELECT * FROM posts WHERE post_id = $post_id";
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
                        <?php echo $postTitle ?>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $postAuthor ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $postImg ?>" alt="image">
                    <hr>
                    <p><?php echo $postContent ?></p>
                    <hr>
                <?php }?>
                
                <?php include 'includes/comments.php' ?>        

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