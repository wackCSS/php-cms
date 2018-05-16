<?php
    function render_form() {
        global $connection;

        if (isset($_GET['edit'])) {
            $the_cat_to_edit_id = $_GET['edit'];                                        

            $queryCats = "SELECT * FROM categories  cat_id = $the_cat_to_edit_id";
            $editCatResults = mysqli_query($connection, $queryCats);

                while( $rows = mysqli_fetch_assoc($editCatResults) ) {
                    $catId = isset($rows['cat_id']) ? $rows['cat_id'] : '';
                    $catTitle = isset($rows['cat_title']) ? $rows['cat_title'] : '';
                
                include 'includes/category_edit.php';                                                
                }
        }  else {                                        
            include 'includes/category_insert.php';                                                
        }
    }

    function insert_categories(){
        global $connection;

        if (isset($_POST['submit'])) {
            if( !empty($_POST['cat_title']) ) {
                
                $category = $_POST['cat_title'];                                        

                $query =  "INSERT INTO categories(cat_title)";
                $query .= "VALUE ('$category')";            

                $result = mysqli_query($connection, $query);

                if(!$result) {
                    die('query failed' . msqli_error());
                } else {
                    echo '<p>Record saved</p><br>';
                }
            } else {
                echo '<p class="error">Please enter a category</p><br>';
            }        
        }
    }

    function update_categories(){
        global $connection;

        if (isset($_POST['update'])) {
            if( !empty($_POST['cat_title_edit']) ) {
                $updateCategory = $_POST['cat_title_edit'];
                $updateId = $_POST['cat_id_edit'];

                $query =  "UPDATE categories SET ";
                $query .= "cat_title = '$updateCategory' ";                                        
                $query .= "WHERE cat_id = $updateId";            

                $result = mysqli_query($connection, $query);
                
                if(!$result) {
                    die('query failed' . mysqli_error($connection));
                } else {
                    echo 'Record updated <br>';
                    header('Location: categories.php');
                }
            }
        }
    }

    function find_all_categories() {
        global $connection;

        $queryCats = "SELECT * FROM categories";
        $catResults = mysqli_query($connection, $queryCats);

        while( $rows = mysqli_fetch_assoc($catResults) ) {
            $catId = $rows['cat_id'];
            $catTitle = $rows['cat_title'];

            echo '<tr>';
            echo    '<td>' . $catId . '</td>';
            echo    '<td>' . $catTitle . '</td>';
            echo    '<td><a href="categories.php?delete=' . $catId . '">Delete</a></td>';
            echo    '<td><a href="categories.php?edit=' . $catId . '">Edit</a></td>';
            echo '</tr>';                             
        }
    }

    function delete_category() {
        global $connection;

        if (isset($_GET['delete'])) {
            $the_cat_id = $_GET['delete'];

            $query = "DELETE FROM categories ";
            $query .= "WHERE cat_id = {$the_cat_id}";

            $deleteCatQuery = mysqli_query($connection, $query);

            if (!$deleteCatQuery) {
                die('query failed ' . mysqli_error($connection));
            } else {
                header('Location: categories.php');                                                
            }
        } 
    }

    function delete_post() {
        global $connection;

        if (isset($_GET['delete'])) {
            $the_post_id = $_GET['delete'];

            $query = "DELETE FROM posts ";
            $query .= "WHERE post_id = {$the_post_id}";

            $deletePostQuery = mysqli_query($connection, $query);

            if (!$deletePostQuery) {
                die('query failed ' . mysqli_error($connection));
            } else {
                header('Location: posts.php');                                                
            }
        }
    }

    function delete_comment() {
        global $connection;
    
        if (isset($_GET['delete'])) {
            $the_comment_id = $_GET['delete'];

            $query = "DELETE FROM comments ";
            $query .= "WHERE comment_id = {$the_comment_id}";

            $deleteCommentQuery = mysqli_query($connection, $query);

            if (!$deleteCommentQuery) {
                die('query failed ' . mysqli_error($connection));
            } else {
                header('Location: comments.php');                                                
            }
        }
    }

    function approve_comment() {
        global $connection;
    
        if (isset($_GET['approve'])) {
            $the_comment_id = $_GET['approve'];

            $query =  "UPDATE comments SET ";
            $query .= "comment_status = 'approved' ";                                        
            $query .= "WHERE comment_id = {$the_comment_id}";     

            $deleteCommentQuery = mysqli_query($connection, $query);

            if (!$deleteCommentQuery) {
                die('query failed ' . mysqli_error($connection));
            } else {
                header('Location: comments.php');                                                
            }
        }
    }

    function unapprove_comment() {
        global $connection;
    
        if (isset($_GET['unapprove'])) {
            $the_comment_id = $_GET['unapprove'];

            $query =  "UPDATE comments SET ";
            $query .= "comment_status = 'unapproved' ";                                        
            $query .= "WHERE comment_id = {$the_comment_id}";     

            $deleteCommentQuery = mysqli_query($connection, $query);

            if (!$deleteCommentQuery) {
                die('query failed ' . mysqli_error($connection));
            } else {
                header('Location: comments.php');                                                
            }
        }
    }
    
    function delete_User() {
        global $connection;
    
        if (isset($_GET['delete_user'])) {
            $the_user_id = $_GET['delete_user'];

            $query = "DELETE FROM users ";
            $query .= "WHERE user_id = {$the_user_id}";

            $deleteUserQuery = mysqli_query($connection, $query);

            if (!$deleteUserQuery) {
                die('query failed ' . mysqli_error($connection));
            } else {
                header('Location: users.php');                                                
            }
        }
    }

    function check_query($query) {
        global $connection;

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die('query failed' . mysqli_error($connection));
        }
    }    
?>