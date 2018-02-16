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
        echo    '<td>' . $postCatId . '</td>';
        echo    '<td>' . $postTitle . '</td>';
        echo    '<td>' . $postAuthor . '</td>';
        echo    '<td>' . $postDate . '</td>';
        echo    '<td>' . $postTags . '</td>';
        echo    '<td>' . $postCommentCount . '</td>';
        echo    '<td>' . $postStatus . '</td>';
        echo    '<td><a href="posts.php?source=edit_posts&id=' . $postId . '">Edit</a></td>';
        echo    '<td><a href="posts.php?delete=' . $postId . '">Delete</a></td>';
        echo '</tr>';                             
    }
?>         