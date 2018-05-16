<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>Post ID</th>
        <th>Category ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Tags</th>
        <th>Comment count</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>

<?php
    global $connection;

    delete_post();
    
    $queryPosts = "SELECT * FROM posts";
    $postsResults = mysqli_query($connection, $queryPosts);

    while( $rows = mysqli_fetch_assoc($postsResults) ) {
        $postId = $rows['post_id'];
        $postCatId = $rows['post_category_id'];
        $postTitle = $rows['post_title'];
        $postAuthor = $rows['post_author'];
        $postDate = $rows['post_date'];
        $postTags = $rows['post_tags'];
        $postCommentCount = $rows['post_comment_count'];
        $postStatus = $rows['post_status'];

        echo '<tr>';
        echo    '<td>' . $postId . '</td>';

        $queryCats = "SELECT * FROM categories WHERE cat_id = $postCatId";
        $editCatResults = mysqli_query($connection, $queryCats);

        while( $rows = mysqli_fetch_assoc($editCatResults) ) {            
            $catTitle = isset($rows['cat_title']) ? $rows['cat_title'] : '';
            
            echo '<td>' . $catTitle . '</td>';
        }

        echo    '<td><a href="../post.php?id=' . $postId . '">' . $postTitle . '</a></td>';
        echo    '<td>' . $postAuthor . '</td>';
        echo    '<td>' . $postDate . '</td>';
        echo    '<td>' . $postTags . '</td>';

        $queryComentCount = "SELECT count(*) FROM comments WHERE comment_post_id = $postId";
        $comentCountResults = mysqli_query($connection, $queryComentCount);

        $rows = mysqli_fetch_assoc($comentCountResults);
        $postCommentCount = $rows['count(*)'];
        echo    '<td>' . $postCommentCount . '</td>';
        echo    '<td>' . $postStatus . '</td>';
        echo    '<td><a href="posts.php?source=edit_post&id=' . $postId . '">Edit</a></td>';
        echo    '<td><a href="posts.php?delete=' . $postId . '">Delete</a></td>';
        echo '</tr>';                             
    }
?>         