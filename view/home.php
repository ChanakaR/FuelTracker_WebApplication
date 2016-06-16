<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-03-22
 * Time: 12:09 PM
 */

require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");
require_once ("../classes/security/Security.php");

global $response_code;
global $message;


class Home extends AutoLoader{

    private $response_code = "NS";
    private $message;

    function __construct()
    {
        $this->check_for_logged_users();
        $this->check_for_responses();
    }

    private function check_for_logged_users(){
        $sec= new Security();
        if($sec->is_session()){
            $this->username = $_SESSION["username"];
            $this->role = $_SESSION["role"];
            $this->officer_id = $_SESSION["officer_id"];
            $this->name = $_SESSION["name"];
        }
        else{
            header("Location:./login.php");
        }
    }


    private function check_for_responses(){
        if(isset($_GET["driver-json"])){
            $json_data = $_GET["driver-json"];
            $json_send ='{
                    "method" : "INSERT",
                    "class" : "DRIVER",
                    "data" : '.$json_data.'
                }';
            $da = new DataAccess();
            $json_string = $da->insertData($json_send);

            $ary = json_decode($json_string,true);
            $this->response_code = $ary["error_code"];
            $this->message = $ary["message"];

        }
        else if(isset($_GET["vehicle-json"])){
            $json_data = $_GET["vehicle-json"];
            $json_send ='{
                        "method" : "INSERT",
                        "class" : "VEHICLE",
                        "data" : '.$json_data.'
                    }';

            $da = new DataAccess();
            $json_string = $da->insertData($json_send);

            $ary = json_decode($json_string,true);
            $this->response_code = $ary["error_code"];
            $this->message = $ary["message"];
        }
        else if(isset($_GET["officer-json"])){
            $json_data = $_GET["officer-json"];
            $json_send ='{
                        "method" : "INSERT",
                        "class" : "OFFICER",
                        "data" : '.$json_data.'
                    }';

            $da = new DataAccess();

            $json_string = $da->insertData($json_send);
            $ary = json_decode($json_string,true);

            $this->response_code = $ary["error_code"];
            $this->message = $ary["message"];
        }
    }

    public function load_body(){
        $content = '<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1></h1>
              <ol class="breadcrumb">
                <li><a href="#" style = "color: #0d6aad;"><i class="fa fa-question"></i> Help</a></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">';


        if($this->response_code == "NS"){
        }
        elseif($this->response_code == "1"){
            $content .= '<div class="row">
                            <div class="col-lg-11">
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-info"></i> Info!</h4>
                                    '.$this->message.'
                                </div>
                            </div>
                     </div>';
        }
        else{
            $content .= '<div class="row">
                            <div class="col-lg-11">
                                <div class="alert alert-error alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-info"></i> Error!</h4>
                                    '.$this->message.'
                                </div>
                            </div>
                     </div>';
        }


        $content .= '<div class="row">
                <div class="col-lg-4 col-xs-6">

                  <!-- small box -->
                  <div class="small-box">
                    <div class="inner">
                      <img src="../dist/img/home_logo.png" style="height: 200px; width: 300px;">
                    </div>
                  </div>
                </div>
                <div class="col-lg-1">
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua-gradient">
                    <div class="inner">
                      <h3>150</h3>
                      <p>Vehicle Registrations</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-car"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#add-vehicle">Register <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua-gradient">
                    <div class="inner">
                      <h3>44</h3>
                      <p>Driver Registrations</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#add-driver">Register <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>

              <!-- /.row -->
              <div class = "row">
                <div class="col-lg-5">
                    <!-- About Me Box -->
                  <div class="box ">
                    <div class="box-header with-border">
                      <h3 class="box-title">Welcome to FuelTracker</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <p class="text-green">
                        Fuel Tracker is a software system for track fuel consumption and expenditure related to fuel consumption of vehicles.
                      </p>
                      <hr>
                      <p class="text-blue">
                        Fuel tracker allows you to manage vehicles and analyze vehicle stats on fuel consumption effectively.
                      </p>
                      <hr>
                      <p class="text-aqua">
                        For any further information refer into help or contact the developer team.
                      </p>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>

                <div class="col-lg-6">';

        if($this->role=="ADM"){
            $content .= '<div class="small-box bg-teal-active">
                        <div class="inner">
                          <h4>Add officer</h4>
                        </div>
                        <div class="icon">
                          <i class="ion ion-eye"></i>
                        </div>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#add-officer">View <i class="fa fa-arrow-circle-right"></i></a>
                    </div>';
        }


        $content .= '<div class="small-box bg-green-active">
                    <div class="inner">
                      <h4>Available vehicles</h4>
                    </div>
                    <div class="icon">
                      <i class="ion ion-eye"></i>
                    </div>
                    <a href="#" class="small-box-footer" onclick="showAvailableVehicles();">View <i class="fa fa-arrow-circle-right"></i></a>
                  </div>

                  <div class="small-box bg-light-blue-active">
                    <div class="inner">
                      <h4>Available drivers</h4>
                    </div>
                    <div class="icon">
                      <i class="ion ion-eye"></i>
                    </div>
                    <a href="#" class="small-box-footer" onclick="showAvailableDrivers();">View <i class="fa fa-arrow-circle-right"></i></a>
                  </div>



                </div>
              </div>

                <div class="modal fade" id="add-vehicle">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Vehicle</h4>
                      </div>
                      <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Class of Vehicle" name="v_class"><br>
                        <input class="form-control" type="text" placeholder="Licence Plate" name="v_lplate"><br>
                        <input class="form-control" type="text" placeholder="Make" name="v_make"><br>
                        <input class="form-control" type="text" placeholder="Modal" name="v_model"><br>
                        <input class="form-control" type="text" placeholder="Year" name="v_year"><br>
                        Fuel Type: <input class="form-control" type="text" placeholder="Fuel Type" name="v_ftype">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="createVehicleJson()">Save changes</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <div class="modal fade" id="add-driver">
                  <div class="modal-dialog">

                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Driver</h4>
                          </div>
                          <div class="modal-body">
                            <input class="form-control" type="text" placeholder="First Name" name="d_fname"><br>
                            <input class="form-control" type="text" placeholder="Last Name" name="d_lname"><br>
                            <input class="form-control" type="text" placeholder="Address" name="d_address"><br>
                            <input class="form-control" type="text" placeholder="Contact Number" name="d_contact_no"><br>
                            Gender:<select class="form-control" name="d_gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select><br>
                            <input class="form-control" type="text" placeholder="Nic" name="d_nic"><br>
                            <input class="form-control" type="text" placeholder="Driver Id" name="d_driver_id"><br>
                            <input class="form-control" type="text" placeholder="Driving Licence Number" name="d_licence_no">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="save-driver" onclick="createDriverJson()">Save changes</button>
                          </div>
                        </div>

                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <div class="modal fade" id="add-officer">
                  <div class="modal-dialog">

                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Officer</h4>
                          </div>
                          <div class="modal-body">
                            <input class="form-control" type="text" placeholder="First Name" name="o_fname"><br>
                            <input class="form-control" type="text" placeholder="Last Name" name="o_lname"><br>
                            <input class="form-control" type="text" placeholder="Address" name="o_address"><br>
                            <input class="form-control" type="text" placeholder="Contact Number" name="o_contact_no"><br>
                            Gender:<select class="form-control" name="o_gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select><br>
                            <input class="form-control" type="text" placeholder="Nic" name="o_nic"><br>
                            <input class="form-control" type="text" placeholder="Officer Id" name="o_officer_id"><br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="save-driver" onclick="createOfficerJson()">Save changes</button>
                          </div>
                        </div>

                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </section>
            <!-- /.content -->
            </div>';

        echo $content;
    }
}

/*$auto_loader = new AutoLoader();
$auto_loader->load_header();
$auto_loader->load_sidebar('home');
myBody();
$auto_loader->load_footer(); */

$home =new Home();
$home ->load_header();
$home->load_sidebar('home');
$home ->load_body();
$home->load_footer();