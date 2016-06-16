<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-05-21
 * Time: 9:14 AM
 */

require_once ("../classes/data_access/DataAccess.php");
require_once ("../classes/security/Security.php");

class LogIn{

    private $info_message = "";
    private $username=null;

    function __construct()
    {
        $this->check_for_destroy_sessions();
        $this->check_for_responses();
    }

    private function check_for_destroy_sessions(){
        $sec = new Security();
        if($sec->is_session()){
            $sec->stop_session();
        }
    }
    private function check_for_responses(){
        if(isset($_POST["username"]) and isset($_POST["password"])){
            if(empty($_POST["username"]) || empty($_POST["password"])){
                $this->info_message = "All fields are required.";
            }
            else{
                $json_send ='{
                    "method" : "USER_VALIDATION",
                    "username" : "'.$_POST["username"].'",
                    "password" : "'.$_POST["password"].'"
                }';

                $da = new DataAccess();
                $response = $da->userValidation($json_send);
                $response_array =  json_decode($response,true);

                if($response_array["error_code"]==0){
                    $user_name = $response_array["message"][0]["user_name"];
                    $role = $response_array["message"][0]["role"];
                    $name = $response_array["message"][0]["f_name"]." ".$response_array["message"][0]["l_name"];
                    $officer_id= $response_array["message"][0]["officer_id"];
                    $sc = new Security();

                    $sc->set_session_variables($user_name,$role,$name,$officer_id);

                    header("Location: ./home.php");
                }
                else{
                    $this->info_message = "invalid user";
                }
            }
        }
        else{

        }
    }

    public function load_body(){
        echo '<html>
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <title>AdminLTE 2 | Log in</title>
              <!-- Tell the browser to be responsive to screen width -->
              <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
              <!-- Bootstrap 3.3.5 -->
              <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
              <!-- Font Awesome -->
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
              <!-- Ionicons -->
              <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
              <!-- Theme style -->
              <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
              <!-- iCheck -->
              <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

              <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
              <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
              <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->
            </head>
            <body class="hold-transition login-page">
            <div class="login-box">
              <div class="login-logo">
                <b>FUEL </b>TRACKER
              </div>
              <!-- /.login-logo -->
              <div class="login-box-body">
                <p class="login-box-msg">Please Log In</p>
                <form action="login.php" method="post">
                      <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="User name" name="username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>
                      <div class="row">
                        <div class="col-xs-8">
                            <label id="log_info" style="color: maroon">
                            '.$this->info_message.'
                            </label>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                        </div>
                    <!-- /.col -->
                        </div>
                     </form>
              </div>
              <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->

            <!-- jQuery 2.1.4 -->
            <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
            <!-- Bootstrap 3.3.5 -->
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <!-- iCheck -->
            <script src="../plugins/iCheck/icheck.min.js"></script>
            <script src="../js/buttonControl.js"></script>
            <script>
              $(function () {
                $(\'input\').iCheck({
                  checkboxClass: \'icheckbox_square-blue\',
                  radioClass: \'iradio_square-blue\',
                  increaseArea: \'20%\' // optional
                });
              });
            </script>
            </body>
        </html>';
    }
}

$log = new LogIn();
$log->load_body();


