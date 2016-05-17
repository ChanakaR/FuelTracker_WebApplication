<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-03-22
 * Time: 12:09 PM
 */

require_once ("./autoload.php");
require_once ("../modal/DataAccess.php");

if(isset($_GET["driver-json"])){
    $json_data = $_GET["driver-json"];
    $json_send ='{
        "method" : "INSERT",
        "class" : "DRIVER",
        "data" : '.$json_data.'
    }';
    $da = new DataAccess();
    $da->insertData($json_send);

}
else if(isset($_GET["vehicle-json"])){
    $json_data = $_GET["vehicle-json"];
    $json_send ='{
        "method" : "INSERT",
        "class" : "VEHICLE",
        "data" : '.$json_data.'
    }';

    $da = new DataAccess();
    $da->insertData($json_send);
}
else{

}



function myBody(){
    echo '<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Home</h1>
      <ol class="breadcrumb">
        <li><a href="#" style = "color: #0d6aad;"><i class="fa fa-question"></i> Help</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
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
          <div class="small-box bg-green-gradient">
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
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
              <p class="text-muted">Malibu, California</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-lg-6">
            <div class="small-box bg-teal-gradient">
            <div class="inner">
              <h4>Available vehicles</h4>
            </div>
            <div class="icon">
              <i class="ion ion-eye"></i>
            </div>
            <a href="#" class="small-box-footer" >View <i class="fa fa-arrow-circle-right"></i></a>
          </div>

          <div class="small-box bg-gray">
            <div class="inner">
              <h4>Available drivers</h4>
            </div>
            <div class="icon">
              <i class="ion ion-eye"></i>
            </div>
            <a href="#" class="small-box-footer" >View <i class="fa fa-arrow-circle-right"></i></a>
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
                <button type="button" class="btn btn-primary" onclick="createVehicleJsonHome()">Save changes</button>
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
                    <button type="submit" class="btn btn-primary" id="save-driver" onclick="createDriverJsonHome()">Save changes</button>
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
}

load_header();
load_sidebar('home');
myBody();
load_footer();