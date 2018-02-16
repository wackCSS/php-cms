<?php include '../includes/header.php'; ?>
<?php include 'functions.php'; ?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories                            
                        </h1>

                        <?php
                            if ( isset($_GET['source']) ){
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }

                            switch($source){
                                case 'add_post';
                                    include 'includes/add_post.php';
                                break;

                                case 'edit_post';
                                    include 'includes/edit_post.php';
                                break;

                                case 'add_post';
                                    include 'includes/add_post.php';
                                break;

                                default:
                                    include 'includes/view_all_posts.php';
                                break;
                            }

                            //https://www.udemy.com/php-for-complete-beginners-includes-msql-object-oriented/learn/v4/t/lecture/2509338?start=0
                            // 4:06 - copy down add post form
                        ?>                            
                        </tbody>
                       </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include '../includes/footer.php'; ?>