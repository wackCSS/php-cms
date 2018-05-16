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
                            Comments                           
                        </h1>

                        <?php
                            if ( isset($_GET['source']) ){
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }

                            switch($source){
                                case 'add_comment';                                    
                                    include 'includes/add_comment.php';
                                break;

                                case 'edit_comment';
                                    include 'includes/edit_comments.php';
                                break;                

                                default:
                                    include 'includes/view_all_comments.php';
                                break;
                            }                            
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