<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-05-21
 * Time: 9:48 AM
 *
 * AutoLoader - class will load auto headers and footers, including js,css,font files
 */

class AutoLoader
{
    protected $username;
    protected $role;
    protected $name;
    protected $officer_id;

    public function load_header(){
        echo '<html>
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <title>Fuel Tracker</title>
              <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
              <!-- Bootstrap 3.3.5 -->
              <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
              <!-- Font Awesome -->
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
              <!-- Ionicons -->
              <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
              <!-- DataTables -->
               <link rel ="stylesheet" href="../dist/css/table.css">
               <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
              <!-- Modals -->
              <link rel ="stylesheet" href="../dist/css/modal.css">
              <!-- Theme style -->
              <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
              <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
              <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
            </head>
            <body class="hold-transition skin-blue sidebar-mini">
            <div class="wrapper">
              <!-- Main Header -->
              <header class="main-header">
                <!-- Logo -->
                <a href="../controller/controller.php?path=home" class="logo">
                  <!-- mini logo for sidebar mini 50x50 pixels -->
                  <span class="logo-mini"><b>F</b>T</span>
                  <!-- logo for regular state and mobile devices -->
                  <span class="logo-lg"><b>FUEL</b>Tracker</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                  <!-- Sidebar toggle button-->
                  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                  </a>
                  <!-- Navbar Right Menu -->
                  <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                      <!-- Messages: style can be found in dropdown.less-->
                      <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-envelope-o"></i>
                          <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="header">You have 4 messages</li>
                          <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                              <li><!-- start message -->
                                <a href="#">
                                  <div class="pull-left">
                                    <!-- User Image -->
                                    <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                  </div>
                                  <!-- Message title and timestamp -->
                                  <h4>
                                    Support Team
                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                  </h4>
                                  <!-- The message -->
                                  <p>Why not buy a new awesome theme?</p>
                                </a>
                              </li>
                              <!-- end message -->
                            </ul>
                            <!-- /.menu -->
                          </li>
                          <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                      </li>
                      <!-- /.messages-menu -->

                      <!-- User Account Menu -->
                      <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <!-- The user image in the navbar-->
                          <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                          <!-- hidden-xs hides the username on small devices so only the image appears. -->
                          <span class="hidden-xs">'.$this->name.'</span>
                        </a>
                        <ul class="dropdown-menu">
                          <!-- The user image in the menu -->
                          <li class="user-header">
                            <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                              '.$this->name.' - '.$this->role.'
                              <small>'.$this->officer_id.'</small>
                            </p>
                          </li>
                          <!-- Menu Footer-->
                          <li class="user-footer">
                            <div class="pull-left">
                              <a href="../controller/controller.php?path=profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                              <a href="../view/login.php?m=so" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </nav>
              </header>';
    }

    public function load_sidebar($activeElement){
        $content= '';
        $content .= '<aside class="main-sidebar">
                     <section class="sidebar">

                      <!-- Sidebar user panel (optional) -->
                      <div class="user-panel">
                        <div class="pull-left image">
                          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                          <p>'.$this->name.'</p>
                          <!-- Status -->
                          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                      </div>

                      <!-- Sidebar Menu -->
                      <ul class="sidebar-menu">
                        <li class="header"></li>';

                        $list="";
                        switch($activeElement){
                            case 'home':
                                $list ='<li class="active"><a href="../controller/controller.php?path=home"><i class="fa fa-bank"></i> <span>Home</span></a></li>
                                        <li><a href="../controller/controller.php?path=vehicle"><i class="fa fa-cab"></i> <span>Vehicles</span></a></li>
                                        <li><a href="../controller/controller.php?path=driver"><i class="fa fa-users"></i> <span>Drivers</span></a> </li>
                                        <li><a href="../controller/controller.php?path=trip"><i class="fa fa-map-o"></i> <span>Trips</span></a> </li>';
                                if($this->role == "ADM"){
                                    $list .= '<li><a href="../controller/controller.php?path=officer"><i class="fa fa-line-chart"></i><span>Officers</span></a></li>';
                                }
                                $list .='<li><a href="../controller/controller.php?path=profile"><i class="fa fa-cogs"></i> <span>Profile Settings</span></a> </li>';
                                break;
                            case 'vehicle':
                                $list ='<li ><a href="../controller/controller.php?path=home"><i class="fa fa-bank"></i> <span>Home</span></a></li>
                                        <li class="active"><a href="../controller/controller.php?path=vehicle"><i class="fa fa-cab"></i> <span>Vehicles</span></a></li>
                                        <li><a href="../controller/controller.php?path=driver"><i class="fa fa-users"></i> <span>Drivers</span></a> </li>
                                        <li><a href="../controller/controller.php?path=trip"><i class="fa fa-map-o"></i> <span>Trips</span></a> </li>';
                                if($this->role == "ADM"){
                                    $list .= '<li><a href="../controller/controller.php?path=officer"><i class="fa fa-line-chart"></i><span>Officers</span></a></li>';
                                }
                                    $list .='<li><a href="../controller/controller.php?path=profile"><i class="fa fa-cogs"></i> <span>Profile Settings</span></a> </li>';
                                break;
                            case 'driver':
                                $list ='<li ><a href="../controller/controller.php?path=home"><i class="fa fa-bank"></i> <span>Home</span></a></li>
                                        <li><a href="../controller/controller.php?path=vehicle"><i class="fa fa-cab"></i> <span>Vehicles</span></a></li>
                                        <li class="active"><a href="../controller/controller.php?path=driver"><i class="fa fa-users"></i> <span>Drivers</span></a> </li>
                                        <li><a href="../controller/controller.php?path=trip"><i class="fa fa-map-o"></i> <span>Trips</span></a> </li>';
                                if($this->role == "ADM"){
                                    $list .= '<li><a href="../controller/controller.php?path=officer"><i class="fa fa-line-chart"></i><span>Officers</span></a></li>';
                                }
                                $list .='<li><a href="../controller/controller.php?path=profile"><i class="fa fa-cogs"></i> <span>Profile Settings</span></a> </li>';
                                break;
                            case 'officer':
                                $list ='<li ><a href="../controller/controller.php?path=home"><i class="fa fa-bank"></i> <span>Home</span></a></li>
                                        <li><a href="../controller/controller.php?path=vehicle"><i class="fa fa-cab"></i> <span>Vehicles</span></a></li>
                                        <li><a href="../controller/controller.php?path=driver"><i class="fa fa-users"></i> <span>Drivers</span></a> </li>
                                        <li><a href="../controller/controller.php?path=trip"><i class="fa fa-map-o"></i> <span>Trips</span></a> </li>';

                                if($this->role == "ADM"){
                                    $list .= '<li class="active"><a href="../controller/controller.php?path=officer"><i class="fa fa-line-chart"></i><span>Officers</span></a></li>';
                                }
                                $list .='<li><a href="../controller/controller.php?path=profile"><i class="fa fa-cogs"></i> <span>Profile Settings</span></a> </li>';
                                break;

                            case 'profile':
                                $list ='<li ><a href="../controller/controller.php?path=home"><i class="fa fa-bank"></i> <span>Home</span></a></li>
                                        <li><a href="../controller/controller.php?path=vehicle"><i class="fa fa-cab"></i> <span>Vehicles</span></a></li>
                                        <li><a href="../controller/controller.php?path=driver"><i class="fa fa-users"></i> <span>Drivers</span></a> </li>
                                        <li><a href="../controller/controller.php?path=trip"><i class="fa fa-map-o"></i> <span>Trips</span></a> </li>';

                                if($this->role == "ADM"){
                                    $list .= '<li><a href="../controller/controller.php?path=officer"><i class="fa fa-line-chart"></i><span>Officers</span></a></li>';
                                }
                                $list .='<li class="active"><a href="../controller/controller.php?path=profile"><i class="fa fa-cogs"></i> <span>Profile Settings</span></a> </li>';
                                break;

                            case 'trip':
                                $list ='<li ><a href="../controller/controller.php?path=home"><i class="fa fa-bank"></i> <span>Home</span></a></li>
                                        <li><a href="../controller/controller.php?path=vehicle"><i class="fa fa-cab"></i> <span>Vehicles</span></a></li>
                                        <li><a href="../controller/controller.php?path=driver"><i class="fa fa-users"></i> <span>Drivers</span></a> </li>
                                        <li class = "active"><a href="../controller/controller.php?path=trip"><i class="fa fa-map-o"></i> <span>Trips</span></a> </li>';

                                if($this->role == "ADM"){
                                    $list .= '<li><a href="../controller/controller.php?path=officer"><i class="fa fa-line-chart"></i><span>Officers</span></a></li>';
                                }
                                $list .='<li><a href="../controller/controller.php?path=profile"><i class="fa fa-cogs"></i> <span>Profile Settings</span></a> </li>';

                                break;
                        }


                        $content .= $list.'</ul>
                      <!-- /.sidebar-menu -->
                    </section>
                    <!-- /.sidebar -->
                  </aside>';
        echo $content;
    }

    public function load_footer(){
        echo '<footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 <a href="#">bmCSoft</a>.</strong> All rights reserved.
                </footer>
                </div>
                <!-- ./wrapper -->

                <!-- REQUIRED JS SCRIPTS -->

                <!-- jQuery 2.1.4 -->
                <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
                <!-- Bootstrap 3.3.5 -->
                <script src="../bootstrap/js/bootstrap.min.js"></script>
                <!-- AdminLTE App -->
                <script src="../dist/js/app.min.js"></script>
                <script src="../js/JsonMaker.js"></script>

                <script src="../js/buttonControl.js"></script>
                </body>
                </html>';
    }

    public function load_footer_charts()
    {

        echo '<footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 <a href="#">bmCSoft</a>.</strong> All rights reserved.
                </footer>
                </div>
                <!-- ./wrapper -->

                <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
                <!-- Bootstrap 3.3.5 -->
                <script src="../bootstrap/js/bootstrap.min.js"></script>
                <!-- ChartJS 1.0.1 -->
                <script src="../plugins/chartjs/Chart.min.js"></script>
                <!-- DataTables -->
                <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
                <!-- SlimScroll -->
                <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
                <!-- FastClick -->
                <script src="../plugins/fastclick/fastclick.js"></script>
                <!-- AdminLTE App -->
                <script src="../dist/js/app.min.js"></script>
                <!-- AdminLTE for demo purposes -->
                <script src="../dist/js/demo.js"></script>
                <!-- page script -->
                <script src="../js/chart.js"></script>
                <!-- table script -->
                <script src="../js/buttonControl.js"></script>
                <script src="../js/table.js"></script>
                <script src="../js/JsonMaker.js"></script>
                </body>
                </html>';
    }

    public function load_footer_tables(){
        echo '<footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 <a href="#">bmCSoft</a>.</strong> All rights reserved.
                </footer>
                </div>
                <!-- ./wrapper -->

                <!-- REQUIRED JS SCRIPTS -->


                <!-- jQuery 2.1.4 -->
                <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
                <!-- Bootstrap 3.3.5 -->
                <script src="../bootstrap/js/bootstrap.min.js"></script>
                <!-- DataTables -->
                <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
                <!-- SlimScroll -->
                <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
                <!-- FastClick -->
                <script src="../plugins/fastclick/fastclick.js"></script>
                <!-- AdminLTE App -->
                <script src="../dist/js/app.min.js"></script>
                <!-- table script -->
                <script src="../js/buttonControl.js"></script>
                <script src="../js/table.js"></script>
                <script src="../js/JsonMaker.js"></script>

                </body>
                </html>';
    }
}