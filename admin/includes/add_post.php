<?php
if ( isset( $_POST['submit']) ) {
    echo 'YESYES';
    print_r($_POST['post_title']);
}

    //https://www.udemy.com/php-for-complete-beginners-includes-msql-object-oriented/learn/v4/t/lecture/2509338?start=0
    // 4:06 - copy down add post form
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post category ID</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>

    <div class="form-group">
        <label for="post_author">Post author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_date">Post date</label>
        <input type="text" class="form-control" name="post_date">
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
        <textarea class="form-control" name="post_content" cols="30" rows="10">
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish post" />
    </div>
</form>