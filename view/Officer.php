<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-06-13
 * Time: 10:11 AM
 */


require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");

class Officer extends AutoLoader
{
    function __construct()
    {
        $this->check_for_responses();
    }

    private function check_for_responses(){
        if(isset($_GET["vehicle-json"])){
            $json_data = $_GET["vehicle-json"];
            $json_send ='{
                    "method" : "INSERT",
                    "class" : "VEHICLE",
                    "data" : '.$json_data.'
                }';

            $da = new DataAccess();
            $da->insertData($json_send);
        }
    }

    public function load_body(){
        $content = '<div class="content-wrapper" style="height:120%;">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                      <h1>
                    Officers
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
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-driver"><icon class="fa fa-plus-square-o"></icon> Add</button>
                        <button class="btn btn-primary" id="edit-driver" data-toggle="modal" onclick=""><icon class="fa fa-edit"></icon> Edit</button>
                        <button class="btn btn-danger" id="remove-driver" data-toggle="modal" onclick=""><icon class="fa fa-minus-square-o"></icon> Remove</button>
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
                                  <th>Officer Id</th>
                                  <th>First name</th>
                                  <th>Address</th>
                                  <th>Contact No</th>
                                  <th>Gender</th>
                                  <th>NIC</th>
                                </tr>
                                </thead>
                                <tbody>';

                        $content .= $this->getTableBody();

                        $content .= '</tbody>
                                <tfoot>
                                <tr>
                                  <th>Officer Id</th>
                                  <th>First name</th>
                                  <th>Address</th>
                                  <th>Contact No</th>
                                  <th>Gender</th>
                                  <th>NIC</th>
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

                    </section>
                    <!-- /.content -->
                  </div>';

        echo $content;
    }

    private function getTableBody(){
        $json_send = '{
                "method" : "SELECT",
                "class" : "OFFICER",
                "select" : "ALL",
                "data" : "SELECT_ALL"
              }';
        $dataAccess = new DataAccess();
        $data_receive = $dataAccess->selectData($json_send);

        $table_body='';
        foreach($data_receive as $item){
            $table_body .= '<tr id ="'.$item["id"].'" >
                          <td>'.$item['officer_id'].'</td>
                          <td>'.$item['f_name'].'</td>
                          <td>'.$item['address'].'</td>
                          <td>'.$item['contact_no'].'</td>
                          <td>'.$item['gender'].'</td>
                          <td>'.$item['nic'].'</td>
                        </tr>';
        }
        return $table_body;
    }
}

$officer = new Officer();

$officer->load_header();
$officer->load_sidebar('officer');
$officer->load_body();
$officer->load_footer_tables();