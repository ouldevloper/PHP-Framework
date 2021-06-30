<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>3a9ar Ait Baha | Admin Panel</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="<?=  assets('bootstrap/css/bootstrap.min.css');  ?>" 							rel="stylesheet" type="text/css" />
    <link href="<?=  assets('bootstrap/css/font-awesome.css');  ?>" 							rel="stylesheet" type="text/css" /> 
    <link href="<?=  assets('dist/css/AdminLTE.min.css');  ?>" 								rel="stylesheet" type="text/css" />
    <link href="<?=  assets('dist/css/skins/_all-skins.min.css');  ?>" 						rel="stylesheet" type="text/css" />
    <link href="<?=  assets('plugins/iCheck/flat/blue.css');  ?>" 								rel="stylesheet" type="text/css" />
    <link href="<?=  assets('plugins/morris/morris.css');  ?>" 								rel="stylesheet" type="text/css" />
    <link href="<?=  assets('plugins/jvectormap/jquery-jvectormap-1.2.2.css');  ?>" 			rel="stylesheet" type="text/css" />
    <link href="<?=  assets('plugins/datepicker/datepicker3.css');  ?>" 						rel="stylesheet" type="text/css" />
    <link href="<?=  assets('plugins/daterangepicker/daterangepicker-bs3.css');  ?>" 			rel="stylesheet" type="text/css" />
    <link href="<?=  assets('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');  ?>" 	rel="stylesheet" type="text/css" />
    <link href="<?=  assets('plugins/datatables/dataTables.bootstrap.css');  ?>" 				rel="stylesheet" type="text/css" />
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" 		rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" 				rel="stylesheet" type="text/css" />  
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      table >thead >tr >td{
        text-align: center;
        width: initial;
      }
      tr{
        text-align: center;
        max-width: inherit;
      }
      .table >thead >tr >td{
            background-color: #d10531;
            color: #fff;
      }
    </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        
        <a href="#" class="logo"><b>Admin</b> Panel</a>
        
        <nav class="navbar navbar-static-top" role="navigation">
          
          <a href="#" onclick="resizeTables()" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">                        
              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Abdellah Oulahyane</span>
                  <img src="<?=  assets('dist/img/user2-160x160.jpg');   ?>" class="user-image" alt="User Image"/>
                </a>
                <ul class="dropdown-menu">
                  
                  <li class="user-header">
                    <img src="<?=  assets('dist/img/user2-160x160.jpg');   ?>" class="img-circle" alt="User Image" />
                    <p>
                      Abdellah Oulahyane - Full Stack Developer
                      <small>Member since Jan. 2019</small>
                    </p>
                  </li>
                  
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>

      </header>
      
      <aside class="main-sidebar">
        
        <section class="sidebar">
          
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=  assets('dist/img/user2-160x160.jpg');   ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Abdellah Oulahyane</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-inbox"></i>
                <span>Messages</span>
                
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>Offers</span>
                <span class="label label-primary pull-right">1</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-plus"></i> New Offer</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Accounts</span>
                <span class="label label-primary pull-right">1</span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-plus"></i> New Account</a></li>
              </ul>
            </li> 
          </ul>
        </section>
        
      </aside>
      
      <div class="content-wrapper">
        