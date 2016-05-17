/**
 * Created by bmCSoft on 2016-03-25.
 *
 * create json string from the forms
 * still validation and error checking does not added
 */

/*
 * create driver details json string
 * inputs get from the driver insert form
 */
function createDriverJsonHome() {
    var f_name = document.getElementsByName("d_fname")[0].value;
    var l_name = document.getElementsByName("d_lname")[0].value;
    var address = document.getElementsByName("d_address")[0].value;
    var contact_no = document.getElementsByName("d_contact_no")[0].value;
    var gender = document.getElementsByName("d_gender")[0].value;
    var nic = document.getElementsByName("d_nic")[0].value;
    var driver_id = document.getElementsByName("d_driver_id")[0].value;
    var licence_no = document.getElementsByName("d_licence_no")[0].value;

    var json_string ='{ "first_name":"'+f_name+'",'+
                        '"last_name":"'+l_name+'",'+
                        '"address":"'+address+'",'+
                        '"contact_no":"'+contact_no+'",'+
                        '"gender":"'+gender+'",'+
                        '"nic":"'+nic+'",'+
                        '"driver_id":"'+driver_id+'",'+
                        '"licence_no":"'+licence_no+'"}';

    window.location.href ="../view/home.php?driver-json="+json_string;

}

function createDriverJsonDriver(){
    var f_name = document.getElementsByName("d_fname")[0].value;
    var l_name = document.getElementsByName("d_lname")[0].value;
    var address = document.getElementsByName("d_address")[0].value;
    var contact_no = document.getElementsByName("d_contact_no")[0].value;
    var gender = document.getElementsByName("d_gender")[0].value;
    var nic = document.getElementsByName("d_nic")[0].value;
    var driver_id = document.getElementsByName("d_driver_id")[0].value;
    var licence_no = document.getElementsByName("d_licence_no")[0].value;

    var json_string ='{ "first_name":"'+f_name+'",'+
        '"last_name":"'+l_name+'",'+
        '"address":"'+address+'",'+
        '"contact_no":"'+contact_no+'",'+
        '"gender":"'+gender+'",'+
        '"nic":"'+nic+'",'+
        '"driver_id":"'+driver_id+'",'+
        '"licence_no":"'+licence_no+'"}';

    window.location.href ="../view/driver.php?driver-json="+json_string;

}


/*
 * create vehicle details json string
 * inputs get from the vehicle insert form
 *
 */
function createVehicleJsonHome(){

    var v_class = document.getElementsByName('v_class')[0].value;
    var make = document.getElementsByName('v_make')[0].value;
    var model = document.getElementsByName('v_model')[0].value;
    var year = document.getElementsByName('v_year')[0].value;
    var lplate = document.getElementsByName('v_lplate')[0].value;
    var ftype = document.getElementsByName('v_ftype')[0].value;

    var json_string ='{ "v_class":"'+v_class+'",'+
        '"make":"'+make+'",'+
        '"model":"'+model+'",'+
        '"year":"'+year+'",'+
        '"lplate":"'+lplate+'",'+
        '"ftype":"'+ftype+'"}';

    window.location.href ="../view/home.php?vehicle-json="+json_string;
}

function createVehicleJsonVehicle(){

    var v_class = document.getElementsByName('v_class')[0].value;
    var make = document.getElementsByName('v_make')[0].value;
    var model = document.getElementsByName('v_model')[0].value;
    var year = document.getElementsByName('v_year')[0].value;
    var lplate = document.getElementsByName('v_lplate')[0].value;
    var ftype = document.getElementsByName('v_ftype')[0].value;

    var json_string ='{ "v_class":"'+v_class+'",'+
        '"make":"'+make+'",'+
        '"model":"'+model+'",'+
        '"year":"'+year+'",'+
        '"lplate":"'+lplate+'",'+
        '"ftype":"'+ftype+'"}';

    window.location.href ="../view/vehicle.php?vehicle-json="+json_string;
}

function createVehicleEditJsonVehicle(){
    var v_class = document.getElementById('e_v_class').value;
    var make = document.getElementById('e_v_make').value;
    var model = document.getElementById('e_v_model').value;
    var year = document.getElementById('e_v_year').value;
    var lplate = document.getElementById('e_v_lplate').value;
    var ftype = document.getElementById('e_v_ftype').value;
    var v_id = document.getElementById('v_id').value;

    var json_string ='{ "v_id":"'+v_id+'",'+
        '"v_class":"'+v_class+'",'+
        '"make":"'+make+'",'+
        '"model":"'+model+'",'+
        '"year":"'+year+'",'+
        '"lplate":"'+lplate+'",'+
        '"ftype":"'+ftype+'"}';
    window.location.href ="../view/vehicle.php?vehicle-edit-json="+json_string;
}

function createVehicleDeleteJson(){
    var v_id = document.getElementById("d_v_id").value;
    var json_string = '{"v_id":"'+v_id+'"}';
    window.location.href ="../view/vehicle.php?vehicle-delete-json="+json_string;
}