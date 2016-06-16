<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-06-13
 * Time: 9:51 PM
 */

require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");
require_once ("../classes/security/Security.php");

class Trip extends AutoLoader
{
    function __construct()
    {
        $this->check_for_logged_users();
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


    public function load_body(){
        $content = '<div class="content-wrapper" style="height:120%;">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                      <h1>
                    Vehicle trips
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
                      <div class="option-bar" style="margin: 10px;float: right;">
                      </div>
                      </div>
                      <div class="row">

                        <!-- /.row -->
                        <div class="col-xs-12">
                          <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr class="selected">
                                  <th>Start date</th>
                                  <th>End date</th>
                                  <th>Description</th>
                                  <th>Start time</th>
                                  <th>End time</th>
                                  <th>Driver</th>
                                  <th>Vehicle</th>
                                  <th>Distance (km)</th>
                                </tr>
                                </thead>
                                <tbody>';

        $content .= $this->getTableBody();

        $content .= '</tbody>
                                <tfoot>
                                <tr>
                                  <th>Start date</th>
                                  <th>End date</th>
                                  <th>Description</th>
                                  <th>Start time</th>
                                  <th>End time</th>
                                  <th>Driver</th>
                                  <th>Vehicle</th>
                                  <th>Distance (km)</th>
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


                        <!-- /.modal -->

                    </section>
                    <!-- /.content -->
                  </div>';

        echo $content;
    }

    private function getTableBody(){
       $json_send = '{
                "method" : "SELECT",
                "class" : "TRIP",
                "select" : "ALL",
                "data" : "SELECT_ALL"
              }';
        $dataAccess = new DataAccess();
        $data_receive = $dataAccess->selectData($json_send);

        $table_body='';
        foreach($data_receive as $item){
            $table_body .= '<tr id ="'.$item["id"].'" >
                          <td>'.$item['start_date'].'</td>
                          <td>'.$item['end_date'].'</td>
                          <td>'.$item['description'].'</td>
                          <td>'.$item['start_time'].'</td>
                          <td>'.$item['end_time'].'</td>
                          <td>'.$item['driver'].'</td>
                          <td>'.$item['licence_plate'].'</td>
                          <td>'.$item['distance'].'</td>
                        </tr>';
        }
        return $table_body;
    }
}

$trip = new Trip();
$trip->load_header();
$trip->load_sidebar("trip");
$trip->load_body();
$trip->load_footer_tables();