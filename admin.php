<?php include_once"session_login.php" ; 
if (isset($_GET['action'])) {
    if($_GET['action']=="delete"){


        $objproducts->deleteItem($_GET['id']);
        header('location:admin.php');
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
    <title>Admin </title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">

    <script type="text/javascript" src="public/js/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

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
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->

                <div class="dropdown" style="padding: 10px;">
                    <div class="top-btn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >
                        <a href="#">My Account</a>
                       <span class="caret"></span></div>

                       <ul class="dropdown-menu">
                          <li><?php if (isset($current_user)) {
                             echo '<a href="myaccount.php?username='.$current_user[0]['user_name'].'">'.$current_user[0]['user_fullname'].'</a>';

                         }else{
                             echo "<a href='login.php'>Login</a>";
                         } ?></li>
                         <li><a href="logout.php">Logout</a></li>
                     </ul>
                 </div>	
             </ul>

             <!-- /.dropdown -->
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
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>desc</th>
                                <th>image</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <?php foreach ($products as  $product): ?>
                           <tbody>
                               <tr class="odd gradeX" align="center">
                                   <td><?php echo $product['product_id'] ?></td>
                                   <td><?php echo $product['product_name'] ?></td>
                                   <td><?php echo $product['product_price'] ?>USD</td>
                                   <td><?php echo $product['product_desc'] ?></td>
                                   <td><?php echo $product['product_image'] ?></td>
                                   <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin.php?action=delete&id=<?php echo $product['product_id']; ?>"> Delete</a></td>
                                   <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="product_edit.php?id=<?php echo $product['product_id']; ?>">Edit</a></td>
                               </tr>
                           </tbody>
                       <?php endforeach ?>
                   </table>
               </div>
               <!-- /.row -->
           </div>
           <!-- /.container-fluid -->
       </div>
       <!-- /#page-wrapper -->
   </div>
   <!-- /#wrapper -->
</body>
</html>
