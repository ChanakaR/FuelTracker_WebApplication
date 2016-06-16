<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-03-22
 * Time: 12:51 PM
 */

require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");
require_once ("../classes/security/Security.php");

class Driver extends AutoLoader{
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

    public function check_for_responses(){
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
        elseif(isset($_GET["driver-edit-json"])){
            $json_data = $_GET["driver-edit-json"];
            $json_send ='{
                "method" : "UPDATE",
                "class" : "DRIVER",
                "data" : '.$json_data.'
            }';

            $da = new DataAccess();
            $da->updateData($json_send);
        }
        elseif(isset($_GET["driver-delete-json"])){
            $json_data = $_GET["driver-delete-json"];
            $json_send ='{
                "method" : "DELETE",
                "class" : "DRIVER",
                "data" : '.$json_data.'
            }';

            $da = new DataAccess();
            $da->deleteData($json_send);
        }
    }

    public function load_body(){
        $content = '<div class="content-wrapper" style="height:120%;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <h1>
                Drivers
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="#" style = "color: #0d6aad;"><i class="fa fa-question"></i> Help</a></li>
                  </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                  <div class="row">
                  <div class="option-bar" style="margin: 10px;float: right;">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add-driver"><icon class="fa fa-plus-square-o"></icon> Add</button>
                    <button class="btn btn-primary" id="edit-driver" data-toggle="modal" onclick="editDriver()"><icon class="fa fa-edit"></icon> Edit</button>';

        if($this->role=="ADM"){
            $content .= '<button class="btn btn-danger" id="remove-driver" data-toggle="modal" onclick="removeDriver()"><icon class="fa fa-minus-square-o"></icon> Remove</button>';
        }

        $content .= '</div>
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
                              <th>Driver ID</th>
                              <th>First name</th>
                              <th>Last name</th>
                              <th>Address</th>
                              <th>Contact No</th>
                              <th>Gender</th>
                              <th>NIC</th>
                              <th>Driving Licence No.</th>
                              <th>More</th>
                            </tr>
                            </thead>
                            <tbody>';

                    $content .= $this->get_table_body();

                    $content .= '</tbody>
                            <tfoot>
                            <tr>
                              <th>Driver ID</th>
                              <th>First name</th>
                              <th>Last name</th>
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

                    <!-- EDIT DRIVER -->
                        <div class="modal fade" id="edit-driver-modal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Driver</h4>
                              </div>
                              <div class="modal-body">
                                <input class="form-control" type="text" id="e_d_fname"><br>
                                <input class="form-control" type="text" id="e_d_lname"><br>
                                <input class="form-control" type="text" id="e_d_address"><br>
                                <input class="form-control" type="text" id="e_d_contact_no"><br>
                                Gender:<select class="form-control" id="e_d_gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select><br>
                                <input class="form-control" type="text" id="e_d_nic"><br>
                                <input class="form-control" type="text" id="e_d_driver_id"><br>
                                <input class="form-control" type="text" id="e_d_licence_no">
                                <input type="hidden" id="e_d_id" value="">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="createDriverEditJson();">Save changes</button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>

                    <!-- MODAL - VIEW INFO -->
                    <div class="modal fade" id="info-modal">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" style="color:#0d6aad;">Info !</h4>
                          </div>
                          <div class="modal-body">
                            <p>Please select a driver first</p>
                          </div>
                          <div class="modal-footer">

                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade" id="rmv-driver">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" style="color: orangered">Remove Driver !</h4>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" id="r_d_id">
                                <h3>Are you sure ?</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-danger" onclick="createDriverDeleteJson()">Yes</button>
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

    private function get_table_body(){
        $json_send = '{
                "method" : "SELECT",
                "class" : "DRIVER",
                "select" : "ALL",
                "data" : "SELECT_ALL"
              }';
        $dataAccess = new DataAccess();
        $data_receive = $dataAccess->selectData($json_send);

        $table_body='';
        foreach($data_receive as $item){
            $table_body .= '<tr id ="'.$item["id"].'" >
                          <td>'.$item['driver_id'].'</td>
                          <td>'.$item['f_name'].'</td>
                          <td>'.$item['l_name'].'</td>
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
}

$driver = new Driver();
$driver->load_header();
$driver->load_sidebar("driver");
$driver->load_body();
$driver->load_footer_tables();