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

                        <div class="col-xs-6">
                            <?php insert_categories(); ?>    
                            <?php update_categories(); ?>                               

                            <form action="" method="post">
                                <?php render_form(); ?>                                
                            </form>
                        </div>                       
                        <div class="col-xs-6">
                         
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php find_all_categories(); ?>
                                    <?php delete_category(); ?>
                                </tbody>
                            </table>

                        </div>
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