<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-06-12
 * Time: 10:42 PM
 */

require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");

function myBody(){


    $content = '<div class="content-wrapper" style="height:120%;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Available Vehicles
      </h1>
      <ol class="breadcrumb">
        <li><a href="#" style = "color: #0d6aad;"><i class="fa fa-question"></i> Help</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!--<div class="row">
        <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header">
              <h3 class="box-title">Connecting...</h3>
            </div>
            <div class="box-body">
              this may take few seconds.
            </div>
            <!-- /.box-body -->
            <!-- Loading (remove the following to stop the loading)->
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading ->
          </div>
          <!-- /.box ->
        </div>
      </div>-->

      <div class="row">

        <!-- /.row -->
        <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="selected">
                  <th>Class</th>
                  <th>Licence plate</th>
                  <th>Make</th>
                  <th>Modal</th>
                  <th>Year</th>
                  <th>Fuel type</th>
                  <th>More</th>
                </tr>
                </thead>
                <tbody>';

    $content .= getTableBody();

    $content .= '</tbody>
                <tfoot>
                <tr>
                  <th>Class</th>
                  <th>Licence plate</th>
                  <th>Make</th>
                  <th>Modal</th>
                  <th>Year</th>
                  <th>Fuel type</th>
                  <th>More</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- MODAL - VIEW VEHICLE STATS -->
        <div class="modal fade" id="vehicle-stat">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Vehicle Info !</h4>
              </div>
              <div class="modal-body">

                <div class="row">
                    <div class="col-sm-4">
                        <img src="../dist/img/car.jpeg" alt="Vehicle Image" style="height: 150px;width: 150px; border:5px solid #a3d0ef;">
                    </div>
                    <div class="col-sm-8 info-dialog">
                        <p id="vehicle-summary">

                        </p>
                        <p>
                        Best driver : Chanaka<br>
                        Best fuel consumption : 7 ltr/km
                        </p>
                    </div>
                </div>

                <div class="row">
                <!-- VEHICLE STAT GRAPHS -->
                    <div class="col-sm-12">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#stats" data-toggle="tab">Stats</a></li>
                          <li><a href="#drivers" data-toggle="tab">Drivers</a></li>
                          <li><a href="#trips" data-toggle="tab">Trips</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="active tab-pane" id="stats">
                            <ul class="timeline timeline-inverse">

                              <!-- timeline item -->
                              <li>
                                <i class="fa  fa-bar-chart bg-green"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                  <h3 class="timeline-header"><a href="#">Stats</a> -vehicle name</h3>

                                  <div class="timeline-body">
                                    Stat details goes here...<br>
                                    some text...some text...some text...some text...some text...some text...some text...
                                    some text...some text...some text...some text...some text...some text...some text...
                                   </div>
                                  <div class="timeline-footer">
                                    <a class="btn btn-success btn-xs" onclick="showVStatInDetail();">show in detail</a>
                                  </div>
                                </div>
                              </li>
                              <!-- END timeline item -->

                            </ul>

                          </div>
                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="drivers">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">

                              <!-- timeline item -->
                              <li>
                                <i class="fa fa-user bg-blue"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                  <h3 class="timeline-header"><a href="#">Drivers</a> - vehicle name</h3>

                                  <div class="timeline-body">
                                    Details of drivers who used the vehicle...<br>
                                    some text...some text...some text...some text...some text...some text...some text...
                                    some text...some text...some text...some text...some text...some text...some text...
                                  </div>
                                  <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">more about drivers</a>
                                  </div>
                                </div>
                              </li>
                              <!-- END timeline item -->

                            </ul>

                          </div>
                          <!-- /.tab-pane -->

                          <div class="tab-pane" id="trips">
                            <ul class="timeline timeline-inverse">

                              <!-- timeline item -->
                              <li>
                                <i class="fa  fa-random bg-orange"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                  <h3 class="timeline-header"><a href="#">Trip</a> - vehicle name</h3>

                                  <div class="timeline-body">
                                    Trip details goes here...<br>
                                    some text...some text...some text...some text...some text...some text...some text...
                                    some text...some text...some text...some text...some text...some text...some text...
                                  </div>

                                </div>
                              </li>
                              <!-- END timeline item -->

                            </ul>
                          </div>
                          <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                      </div>
                      <!-- /.nav-tabs-custom -->
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

        </div>

    </section>
    <!-- /.content -->
  </div>';

    echo $content;
}

function getTableBody(){
    $json_send = '{
                "method" : "SELECT",
                "class" : "VEHICLE",
                "select" : "N_ALL",
                "data" : "AVA_VEHICLE"
              }';
    $dataAccess = new DataAccess();
    $data_receive = $dataAccess->selectData($json_send);
    $table_body='';
    foreach($data_receive as $item){
        $table_body .= '<tr id ="'.$item["id"].'" >
      <td>'.$item['v_class'].'</td>
      <td>'.$item['licence_plate'].'</td>
      <td>'.$item['make'].'</td>
      <td>'.$item['model'].'</td>
      <td>'.$item['year'].'</td>
      <td>'.$item['fuel_type'].'</td>
      <td><button class="btn btn-sm btn-default disabled" data-toggle="modal" ><icon class="fa fa-eye"></icon> view stats</button></td>
    </tr>';
    }
    return $table_body;
}

$auto_loader = new AutoLoader();
$auto_loader->load_header();
$auto_loader->load_sidebar('vehicle');
myBody();
$auto_loader->load_footer_tables();