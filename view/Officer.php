<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-06-13
 * Time: 10:11 AM
 */


require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/data_access/DataAccess.php");
require_once ("../classes/security/Security.php");

class Officer extends AutoLoader
{
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

            if($this->role != "ADM"){
                header("Location:./home.php");
            }
        }
        else{
            header("Location:./login.php");
        }
    }


    private function check_for_responses(){
        if(isset($_GET["officer-json"])){
            $json_data = $_GET["officer-json"];
            $json_send ='{
                    "method" : "INSERT",
                    "class" : "OFFICER",
                    "data" : '.$json_data.'
                }';

            $da = new DataAccess();
            $da->insertData($json_send);
        }
        elseif(isset($_GET["officer-edit-json"])){
            $json_data = $_GET["officer-edit-json"];
            $json_send ='{
                "method" : "UPDATE",
                "class" : "OFFICER",
                "data" : '.$json_data.'
            }';

            $da = new DataAccess();
            $da->updateData($json_send);
        }
        elseif(isset($_GET["officer-delete-json"])){
            $json_data = $_GET["officer-delete-json"];
            $json_send ='{
                "method" : "DELETE",
                "class" : "OFFICER",
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
                    Officers
                      </h1>
                      <ol class="breadcrumb">
                        <li><a href="#" style = "color: #0d6aad;"><i class="fa fa-question"></i> Help</a></li>
                      </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">

                      <div class="row">
                      <div class="option-bar" style="margin: 10px;float: right;">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-officer"><icon class="fa fa-plus-square-o"></icon> Add</button>
                        <button class="btn btn-primary" id="edit-officer" data-toggle="modal" onclick="editOfficer()"><icon class="fa fa-edit"></icon> Edit</button>
                        <button class="btn btn-danger" id="remove-officer" data-toggle="modal" onclick="removeOfficer()"><icon class="fa fa-minus-square-o"></icon> Remove</button>
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
                                  <th>Last name</th>
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
                                  <th>Last name</th>
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

                        <!-- ADD OFFICER -->
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

                        <!-- EDIT OFFICER -->
                        <div class="modal fade" id="edit-officer-modal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Officer</h4>
                              </div>
                              <div class="modal-body">
                                <input class="form-control" type="text" placeholder="First Name" id="e_o_fname"><br>
                                <input class="form-control" type="text" placeholder="Last Name" id="e_o_lname"><br>
                                <input class="form-control" type="text" placeholder="Address" id="e_o_address"><br>
                                <input class="form-control" type="text" placeholder="Contact Number" id="e_o_contact_no"><br>
                                <input type="hidden" id="o_id" value="">
                                Gender:<select class="form-control" id="e_o_gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select><br>
                                <input class="form-control" type="text" placeholder="Nic" id="e_o_nic"><br>
                                <input class="form-control" type="text" placeholder="Officer Id" id="e_o_officer_id"><br>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="createOfficerEditJson();">Save changes</button>
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
                            <p>Please select a officer first</p>
                          </div>
                          <div class="modal-footer">

                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade" id="rmv-officer">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" style="color: orangered">Remove Officer !</h4>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" id="r_o_id">
                                <h3>Are you sure ?</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-danger" onclick="createOfficerDeleteJson()">Yes</button>
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
                          <td>'.$item['l_name'].'</td>
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