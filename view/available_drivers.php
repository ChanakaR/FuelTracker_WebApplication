<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-03-22
 * Time: 12:51 PM
 */

require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");

function myBody(){
    $content = '<div class="content-wrapper" style="height:120%;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Available Drivers
      </h1>
      <ol class="breadcrumb">
        <li><a href="#" style = "color: #0d6aad;"><i class="fa fa-question"></i> Help</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- /.row -->
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="selected">
                  <th>Driver ID</th>
                  <th>First name</th>
                  <th>Address</th>
                  <th>Contact No</th>
                  <th>Gender</th>
                  <th>NIC</th>
                  <th>Driving Licence No.</th>
                  <th>More</th>
                </tr>
                </thead>
                <tbody>';

    $content .= getTableBody();

    $content .= '</tbody>
                <tfoot>
                <tr>
                  <th>Driver ID</th>
                  <th>First name</th>
                  <th>Address</th>
                  <th>Contact No</th>
                  <th>Gender</th>
                  <th>NIC</th>
                  <th>Driving Licence No.</th>
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

    </section>
    <!-- /.content -->
  </div>';

    echo $content;
}

function getTableBody(){
    $json_send = '{
                "method" : "SELECT",
                "class" : "DRIVER",
                "select" : "N_ALL",
                "data" : "AVA_DRIVER"
              }';
    $dataAccess = new DataAccess();
    $data_receive = $dataAccess->selectData($json_send);

    $table_body='';
    foreach($data_receive as $item){
        $table_body .= '<tr id ="'.$item["id"].'" >
      <td>'.$item['driver_id'].'</td>
      <td>'.$item['f_name'].'</td>
      <td>'.$item['address'].'</td>
      <td>'.$item['contact_no'].'</td>
      <td>'.$item['gender'].'</td>
      <td>'.$item['nic'].'</td>
      <td>'.$item['driving_licence_no'].'</td>
      <td><button class="btn btn-sm btn-default disabled" data-toggle="modal" ><icon class="fa fa-eye"></icon> view stats</button></td>
    </tr>';
    }
    return $table_body;
}

$auto_loader = new AutoLoader();
$auto_loader->load_header();
$auto_loader->load_sidebar("driver");
myBody();
$auto_loader->load_footer_tables();