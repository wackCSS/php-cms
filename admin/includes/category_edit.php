<?php
    echo '<div class="form-group">';
    echo    '<label for="cat_title">Edit category</label>';
    echo    '<input type="hidden" name="cat_id_edit" value="' . $catId . '" />';
    echo    '<input type="text" class="form-control" name="cat_title_edit" value= "' . $catTitle .'">';
    echo '</div>';
    echo '<div class="form-group">';
    echo    '<input class="btn btn-primary" type="submit" name="update" value="Edit Category">';
    echo    '<a class="btn btn-secondary" href="categories.php">Cancel</a>';
    echo '</div>';
?>