<?php
    global $connection;

    if ( isset( $_POST['create_post']) ) {
        $postTitle = mysqli_escape_string($connection, $_POST['post_title']);
        $catId = mysqli_escape_string($connection, $_POST['post_category_id']);
        $author = mysqli_escape_string($connection,$_POST['post_author']);
        $status = (isset($_POST['post_status']) && $_POST['post_status'] !== '')? mysqli_escape_string($connection,$_POST['post_status']) : 'draft';        
        $tags = mysqli_escape_string($connection,$_POST['post_tags']);
        
        $img = $_FILES['post_img']['name'];
        $imgTempLocation = $_FILES['post_img']['tmp_name'];
        
        $content = mysqli_escape_string($connection,$_POST['post_content']);
        
        move_uploaded_file($imgTempLocation, '../images/' . $img);

        if ( strlen($postTitle) > 0 &&
        strlen($catId) > 0 &&
        strlen($author) > 0 &&        
        strlen($tags) > 0 &&
        strlen($content) > 0 ) {

            $query = "INSERT INTO posts(post_title, post_category_id, post_author, post_status, post_date, post_tags, post_img, post_content) ";
            $query .= "VALUES ('$postTitle', {$catId}, '$author', '$status', now(), '$tags', '$img', '$content')";
            
            check_query($query);

        } else {
            echo 'Please enter all required post information <br />';
        }
    }    
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post title</label>
        <input type="text" class="form-control" name="post_title">
    </div> 

    <div class="form-group">
        <label for="post_category_id">Post category ID</label>
        <select class="form-control" name="post_category_id" id="post_category_id">
        <?php 
            $queryCats = "SELECT * FROM categories";
            $catResults = mysqli_query($connection, $queryCats);

            while( $rows = mysqli_fetch_assoc($catResults) ) {
                $catId = $rows['cat_id'];
                $catTitle = $rows['cat_title'];

                echo '<option value="' . $catId . '"> ' . $catTitle . '</option>';
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">        
        <label for="post_status">Post status</label>
        <select class="form-control" name="post_status" id="post_status">
            <option value="draft" selected="selected">draft</option>
            <option value="published">published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <!-- TODO: turn into form-->
    <div class="form-group">
        <label for="post_img">Post img</label>
        <input type="file" class="form-control" name="post_img">
    </div> 

    <div class="form-group">
        <label for="post_content">Post content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish post" />
    </div>
</form>