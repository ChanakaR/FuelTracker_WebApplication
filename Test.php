<?php
/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-03-22
 * Time: 12:09 PM
 */

require_once ("./view/autoload.php");

$curl = curl_init();
curl_setopt_array($curl,array(
        CURLOPT_RETURNTRANSFER=>1,
        CURLOPT_URL=> "localhost/FTApplicationServer/zz.php"
    )
);
$result = curl_exec($curl);
echo ($result);

function myBody(){
    echo '<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Page Header
    <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      </section>
    <!-- /.content -->
  </div>';
}


load_header();
load_sidebar('vehicle');
myBody();
load_footer();