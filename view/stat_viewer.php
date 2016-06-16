<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-06-14
 * Time: 2:36 PM
 */

require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");
require_once ("../classes/security/Security.php");

class StatViewer extends AutoLoader
{
    private $vehicle_id;
    function __construct($vehcle_id)
    {
        $this->check_for_logged_users();
        $this->vehicle_id = $vehcle_id;
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
        $content =  '<div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                      <h1>
                    Vehicle Summary
                      </h1>
                      <ol class="breadcrumb">
                        <li><a href="#" style = "color: #0d6aad;"><i class="fa fa-question"></i> Help</a></li>
                      </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                      <input type="hidden" id="vehicle-id" value="'.$this->vehicle_id.'">
                      <!-- Your Page Content Here -->
                        <div class="row">
                            <div class="col-sm-12 info-dialog" style="text-align: center;">';

        $content .= $this->getPageHeader();

        $content .=     '</div>
                        </div>
                      <div class="row">
                            <div class="row">
                              <h4 style="margin-left: 30px;">Graphs</h4>
                             </div>
                                <div class="col-md-6">
                                    <!-- AREA CHART -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Millage(km) vs Month</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="areaChart" style="height:250px"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                </div>
                                <!-- /.col (LEFT) -->
                                <div class="col-md-6">


                                    <!-- BAR CHART -->
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Fuel cost(Rs.) vs Month</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="barChart" style="height:230px"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                </div>
                                <!-- /.col (RIGHT) -->
                            </div>';

        $content .= '<div class="row">
                      <h4 style="margin-left: 20px;">Vehicle trips</h4>
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
                                  <th>Description</th>
                                  <th>distance</th>
                                  <th>Driver</th>
                                  <th>Start time</th>
                                  <th>End time</th>
                                  <th>Start date</th>
                                  <th>End date</th>
                                </tr>
                                </thead>
                                <tbody>';

                        $content .= $this->getTripTableBody();

                        $content .= '</tbody>
                                <tfoot>
                                <tr>
                                  <th>Description</th>
                                  <th>distance</th>
                                  <th>Driver</th>
                                  <th>Start time</th>
                                  <th>End time</th>
                                  <th>Start date</th>
                                  <th>End date</th>
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
                        <!-- /.row -->';

        $content .='</section>
                    <!-- /.content -->
                  </div>';

        echo $content;
    }

    private function getPageHeader(){

        $content ='<p>
                     <b>Vehicle : '.$_GET["vehicle"].'</b><br>
                     Favourite driver : '.$_GET["fd"].'<br>
                     Best fuel consumption : '.$_GET["bfc"].'<br>

                    </p>';
        return $content;
    }

    private function getTripTableBody(){
            $json_send = '{
                        "method" : "SELECT",
                        "class" : "V_TRIP",
                        "select" : "N_ALL",
                        "data" : "'.$this->vehicle_id.'"
                      }';
            $dataAccess = new DataAccess();
            $data_receive = $dataAccess->selectData($json_send);
            $table_body='';
            foreach($data_receive as $item){
                $table_body .= '<tr id ="'.$item["id"].'" >
          <td>'.$item['description'].'</td>
          <td>'.$item['distance'].'</td>
          <td>'.$item['driver_id'].'</td>
          <td>'.$item['start_time'].'</td>
          <td>'.$item['end_time'].'</td>
          <td>'.$item['date'].'</td>
          <td>'.$item['end_date'].'</td>
        </tr>';
            }
        return $table_body;
    }

}

$stat = new StatViewer($_GET["id"]);
$stat->load_header();
$stat->load_sidebar("home");
$stat->load_body();
$stat->load_footer_charts();
