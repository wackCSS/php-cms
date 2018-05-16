<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">    
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
            <!-- /.input-group -->
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <?php 
    global $connection;
    $queryCats = "SELECT * FROM categories LIMIT 10";
    $catResults = mysqli_query($connection, $queryCats);
    $rowCount = mysqli_num_rows($catResults);
    $splitResults = round($rowCount / 2);
    $count = 1;
    $leftArray = [];
    $rightArray = [];    

    function buildList($arr) {
        $index = 0;
        $length = count($arr);
        $html = '';

        foreach($arr as $key => $value) {
            if ($index === 0) {

                $html .= '<div class="col-lg-6">';
                $html .= '<ul class="list-unstyled">';
                $html .= '<li><a href="categories.php?cat_id=' . $key . '">' . $value . '</a>';
                $html .= '</li>';
            
            } else if ($index == $length - 1) {
                $html .= '<li><a href="categories.php?cat_id=' . $key . '">' . $value . '</a>';
                $html .= '</li>';
                $html .= '</ul>';
                $html .= '</div>';
            } else {
                $html .= '<li><a href="categories.php?cat_id=' . $key . '">' . $value . '</a></li>';
            }
            $index++;
        }

        return $html;
    }

    while( $rows = mysqli_fetch_assoc($catResults) ) {
        $catId = $rows['cat_id'];
        $catTitle = $rows['cat_title'];

        if ($count <= $splitResults) {
            $leftArray[$catId] = $catTitle;
        } else {
            $rightArray[$catId] = $catTitle;
        }
        $count++;
    }

    echo buildList($leftArray);
    echo buildList($rightArray);
    ?>            
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include 'widget.php'; ?>

</div>

</div>
<!-- /.row -->