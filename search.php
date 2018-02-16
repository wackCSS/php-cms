<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>  

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Search Results                    
                </h1>
                
                <?php 
                    if ( isset( $_POST['submit']) ){
                        $search =  $_POST['search'];
                    }

                    global $connection;
                    $queryPostTags = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    $searchResult = mysqli_query($connection, $queryPostTags);

                    if(!$searchResult){
                        die('Query Failed: ' . mysqli_error($connection));
                    } else {

                        $count = mysqli_num_rows($searchResult);
                        
                        if($count > 0){
                            while( $row = mysqli_fetch_assoc($searchResult) ) {
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
                        <?php } elseif ($count === 0) {
                            echo '<h2>No results found.</h2>';
                        }      
                    }?>

                
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