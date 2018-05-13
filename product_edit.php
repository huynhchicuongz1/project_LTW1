<?php include_once"session_login.php" ;
    $id=$_GET['id'];
    $objproduct=new Product();
   $product =$objproduct->getItemById($id);
if (isset($_POST['btn-Edit'])) {
    $price=$_POST['txtPrice'];
    $decs=$_POST['txtDesc'];
    $nameItem = $_POST['txtName'];
    $nameImage = $_POST['txtImage'];
     if (is_uploaded_file($_FILES['fileupload']['tmp_name'])) {
        $uploadDir = "public/uploads/";
        $nameFile= basename(time() . $_FILES['fileupload']['name']);
        $targetPath = $uploadDir . basename(time() . $_FILES['fileupload']['name']);
        if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $targetPath) &&
            $objproduct->editItem($id, $nameItem,$price, $decs,  $nameFile)) {
            echo "Edit Successfully.";
            header("Location:admin.php " );
        } else {
            echo "Edit Failed.";
        }
    } else {
        if ($objproduct->editItem($id, $nameItem ,$price, $decs,  $nameImage)) {
            
            echo "Edit Successfully.";
            header("Location:admin.php " );
        } else {

            echo "Edit Failed.";
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title>Admin</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <!-- Bootstrap Core CSS -->
    <link href="public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="public/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="public/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <div class="dropdown">
                                <div class="top-btn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >My Account
                                    <span class="caret"></span></div>
                                    <ul class="dropdown-menu">
                                        <li><?php if (isset($current_user)) {
                                            echo '<a href="#">'.$current_user[0]['user_fullname'].'</a>';

                                        }else{
                                            echo "<a href='login.php'>Login</a>";
                                        } ?></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </div>  
                                
                </div>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Category<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List Category</a>
                                </li>
                                <li>
                                    <a href="#">Add Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Product<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin.php">List Product</a>
                                </li>
                                <li>
                                    <a href="product_add.php">Add Product</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="user_list.php">List User</a>
                                </li>
                                <li>
                                    <a href="#">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="product_edit.php?id=<?php echo $product[0]['product_id']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"class="form-control" name="txtName"  value="<?php echo $product[0]['product_name']; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" name="txtPrice"  value="<?php echo $product[0]['product_price']; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea  class="form-control" rows="3" name="txtDesc"><?php echo $product[0]['product_desc']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="fileupload">
                                <input type="hidden" name="txtImage" value ="<?php echo $product[0]['product_image']; ?>"  >
                            </div>
                            <button type="submit" class="btn btn-default" name="btn-Edit">Product Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                        
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>

</html>
