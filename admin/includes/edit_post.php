<?php

    global $connection;

    if (isset($_GET['id'])) {
        $the_edit_post_id = $_GET['id'];            
        $query = "SELECT * FROM posts ";           
        $query .= "WHERE post_id = {$the_edit_post_id}";        
        check_query($query);
        
        $editPostQuery = mysqli_query($connection, $query);        
        
        while( $rows = mysqli_fetch_assoc($editPostQuery) ) {                            
            $postTitle = isset($rows['post_title']) ? $rows['post_title'] : '';
            $postCatId = isset($rows['post_category_id']) ? $rows['post_category_id'] : '';
            $postAuthor = isset($rows['post_author']) ? $rows['post_author'] : '';
            $postStatus = isset($rows['post_status']) ? $rows['post_status'] : '';
            $postTags = isset($rows['post_tags']) ? $rows['post_tags'] : '';
            $postImg = isset($rows['post_img']) ? $rows['post_img'] : '';
            $postContent = isset($rows['post_content']) ? $rows['post_content'] : '';
            $postDate = isset($rows['post_date']) ? $rows['post_date'] : '';
        }
    }
    
    if ( isset( $_POST['update_post']) ) {
        $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
        $postTitle = mysqli_escape_string($connection, $_POST['post_title']);
        $catId = mysqli_escape_string($connection, $_POST['post_category_id']);
        $author = mysqli_escape_string($connection, $_POST['post_author']);
        $status = (isset($_POST['post_status']) && $_POST['post_status'] !== '')? mysqli_escape_string($connection,$_POST['post_status']) : 'draft';        
        $tags = mysqli_escape_string($connection, $_POST['post_tags']);        
        $post_content = mysqli_escape_string($connection, $_POST['post_content']);

        $img = $_FILES['post_img']['name'];
        if (!empty($img)) {
            $imgTempLocation = $_FILES['post_img']['tmp_name'];       
            move_uploaded_file($imgTempLocation, '../images/' . $img);   
        }

        if ( strlen($postTitle) > 0 &&
        strlen($catId) > 0 &&
        strlen($author) > 0 &&       
        strlen($tags) > 0 &&
        strlen($post_content) > 0 ) {           
            
            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$postTitle}', ";
            $query .= "post_category_id = '{$catId}', ";
            $query .= "post_author = '{$author}', ";
            $query .= "post_status = '{$status}', ";
            $query .= "post_date = now(), ";
            $query .= "post_tags = '{$tags}', ";
            if (!empty($img)) {
                $query .= "post_img = '{$img}', ";
            }
            $query .= "post_content = '{$post_content}' ";
            $query .= "WHERE post_id = {$post_id}"; 

            check_query($query);
            
            header('Location: posts.php'); 

        } else {
            echo 'Please enter all required post information <br />';
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <input type="text" class="form-control hidden" name="post_id" value="<?php echo $the_edit_post_id ?>">

    <div class="form-group">
        <label for="post_title">Post title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $postTitle ?>">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post category</label>
        <select class="form-control" name="post_category_id">
            <?php
                global $connection;
                $query = "SELECT * FROM categories";
                check_query($query);

                $catResults = mysqli_query($connection, $query);

                while( $rows = mysqli_fetch_assoc($catResults) ) {
                    $catId = $rows['cat_id'];
                    $catTitle = $rows['cat_title'];                
                    $isSelected = ($catId === $postCatId) ? 'selected' : '';
                    echo '<option value="' . $catId . '"' . $isSelected . '>' . $catTitle . '</option>';
                }
            ?>
        </select>
    </div>    

    <div class="form-group">
        <label for="post_author">Post author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $postAuthor ?>">
    </div>
    
    <div class="form-group">        
        <label for="post_status">Post status</label>
        <select class="form-control" name="post_status">
            <?php 
                $isPublished = ($postStatus == 'published') ? 'selected="selected"' : '';
                echo '<option value="draft" ' . $isPublished .'>draft</option>';
                echo '<option value="published"' . $isPublished . '>published</option>'
            ?>        
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $postTags ?>">
    </div>    

    <div class="form-group">
        <label for="post_img">Post img</label>
        <div>
            <img height="100" src="../images/<?php echo $postImg ?>" alt="image">
        </div>
        <input type="file" class="form-control" name="post_img">
    </div> 

    <div class="form-group">
        <label for="post_content">Post content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo $postContent ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Edit post" />
    </div>
</form>
