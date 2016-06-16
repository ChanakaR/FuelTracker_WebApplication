<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-04-14
 * Time: 6:04 PM
 */

require_once ("../classes/view/AutoLoader.php");
require_once ("../classes/security/Security.php");

class Profile extends AutoLoader{
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
        $content = '<div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                          <h1>
                        My Profile
                          </h1>
                          <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                            <li class="active">Here</li>
                          </ol>
                        </section>

                        <!-- Main content -->
                        <section class="content">

                          <!-- Your Page Content Here -->
                           <div class="row">
                            <div class="col-md-3">

                              <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile">
                                  <img class="profile-user-img img-responsive img-circle" src="../dist/img/user4-128x128.jpg" alt="User profile picture">

                                  <h3 class="profile-username text-center" id="profile_name">Chanaka Rathnayaka</h3>
                                  <p class="text-muted text-center" id="profile_role">Officer</p>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                              <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#activity" data-toggle="tab">About Me</a></li>
                                  <li><a href="#account" data-toggle="tab">Account Settings</a></li>
                                  <li><a href="#settings" data-toggle="tab">Security Settings</a></li>
                                </ul>
                                <div class="tab-content">
                                  <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post" style="text-align: center;">

                                      <!-- /.user-block -->
                                      <br><p>First Name : Chanaka</p><br>
                                      <p>Last Name : Rathnayaka</p><br>
                                      <p>Address : Heliyagoda,Beligala</p><br>
                                      <p>Contact No : 0712010591</p><br>
                                      <p>Gender : Male</p><br>
                                      <p>Nic : 922984719v</p><br>
                                      <p>Officer Id : OF034</p><br>

                                    </div>

                                    <!-- /.post -->
                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="account">
                                  <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="p_e_first_name" class="col-sm-2 control-label">First name</label>
                                            <div class="col-sm-10">
                                              <input class="form-control" type="text" placeholder="First Name" id="p_e_first_name"><br>
                                            </div>

                                            <label for="p_e_lname" class="col-sm-2 control-label">Last name</label>
                                            <div class="col-sm-10">
                                              <input class="form-control" type="text" placeholder="Last Name" id="p_e_lname"><br>
                                            </div>

                                            <label for="p_e_address" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-10">
                                              <input class="form-control" type="text" placeholder="Address" id="p_e_address"><br>
                                            </div>

                                            <label for="p_e_contact_no" class="col-sm-2 control-label">Contact No.</label>
                                            <div class="col-sm-10">
                                              <input class="form-control" type="text" placeholder="Contact Number" id="p_e_contact_no"><br>
                                            </div>

                                            <label for="p_e_gender" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="p_e_gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select><br>
                                            </div>

                                            <label for="p_e_first_name" class="col-sm-2 control-label">Nic</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Nic" id="p_e_nic"><br>
                                            </div>

                                            <label for="p_e_officer_id" class="col-sm-2 control-label">Officer Id</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Officer Id" id="p_e_officer_id"><br>
                                            </div>
                                            <input type="hidden" id="p_u_id" value="">
                                        </div>
                                  </form>

                                  </div>
                                  <!-- /.tab-pane -->

                                  <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">User name</label>

                                        <div class="col-sm-10">
                                          <input type="email" class="form-control" id="p_e_username" >
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="p_e_password" class="col-sm-2 control-label">Password</label>

                                        <div class="col-sm-10">
                                          <input type="email" class="form-control" id="p_e_password" >
                                        </div>
                                      </div>


                                      <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="submit" class="btn btn-success">Submit</button>
                                          <button type="submit" class="btn btn-default">Cancel</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                  <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                              </div>
                              <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                        </section>
                        <!-- /.content -->
                      </div>';
        echo $content;
    }

}

$profile = new Profile();
$profile->load_header();
$profile->load_sidebar("profile");
$profile->load_body();
$profile->load_footer();

