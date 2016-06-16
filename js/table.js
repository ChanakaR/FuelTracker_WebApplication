/**
 * Created by bmCSoft on 2016-04-15.
 */

$(document).ready(function() {
    /*
     * table - data table in the document
     * path - get the location(url) of the document for identify from where this function
     * is called(vehicle.php or driver.php).
     *
     */
    var table = $('#example1').DataTable();
    var path  = window.location.pathname;

    /*
     * set selected row class to selectedd, then it will highlighted
     * set selected row's button class according to the calling document
     *
     */
    $('#example1 tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selectedd') ) {
            if(path.indexOf("Officer")<0){
                var btn = $(".selectedd")[0].getElementsByTagName("button");
                btn[0].className = "btn btn-sm btn-default disabled";
            }

            $('.disabled').attr('onclick',null);
            $(this).removeClass('selectedd');
        }
        else {
            if(path.indexOf("Officer")<0){
                if($(".view-stat")[0]){
                    var b = $(".view-stat")[0];
                    b.className = "btn btn-sm btn-default disabled";
                    $('.disabled').attr('onclick',null);
                }
            }

            table.$('tr.selectedd').removeClass('selectedd');
            $(this).addClass('selectedd');
            if(path.indexOf("Officer")<0){
                var btn = $(".selectedd")[0].getElementsByTagName("button");
                btn[0].className="btn btn-sm btn-success view-stat";
            }

            if(path.indexOf("vehicle")>-1){
                $('.view-stat').attr('onclick','viewStat(\'vehicle\')');
            }
            else if(path.indexOf('driver')>-1){
                $('.view-stat').attr('onclick','viewStat(\'driver\')');
            }
        }
    } );

} );


function editVehicle(){
    var e_btn = document.getElementById("edit-vehicle");
    var selected_row = document.getElementsByClassName('selectedd');

    if( selected_row.item('tr') != null){
        var td_elements = selected_row[0].getElementsByTagName("td");

        var id = selected_row.item('tr').id;

        var v_class = td_elements[0].innerHTML;
        var lplate =  td_elements[1].innerHTML;
        var make =  td_elements[2].innerHTML;
        var model =  td_elements[3].innerHTML;
        var year =  td_elements[4].innerHTML;
        var ftype =  td_elements[5].innerHTML;


        document.getElementById('e_v_class').value = v_class;
        document.getElementById('e_v_lplate').value = lplate;
        document.getElementById('e_v_make').value = make;
        document.getElementById('e_v_model').value = model;
        document.getElementById('e_v_year').value = model;
        document.getElementById('e_v_ftype').value = ftype;
        document.getElementById('v_id').value = id;

        e_btn.setAttribute("data-target","#edit-vehicle-modal");

    }else{
        e_btn.setAttribute("data-target","#info-modal");
    }
}

function removeVehicle(){
    var r_btn = document.getElementById("remove-vehicle");
    var selected_row = document.getElementsByClassName('selectedd');

    if( selected_row.item('tr') != null){
        var selected_row = document.getElementsByClassName("selectedd");
        var td_elements = selected_row[0].getElementsByTagName("td");
        var v_id = selected_row.item('tr').id;
        var v_class = td_elements[0].innerHTML;
        var lplate =  td_elements[1].innerHTML;
        var make =  td_elements[2].innerHTML;
        var model =  td_elements[3].innerHTML;
        var year =  td_elements[4].innerHTML;
        var ftype =  td_elements[5].innerHTML;

        document.getElementById("d_v_id").value = v_id;
        var p = document.getElementById("d-vehicle-summary");
        p.innerHTML = "Class : "+v_class+"<br>Licence plate : "+lplate+"<br>Make : "+make+"<br>Model : "+model+"<br>Year : "+year+"<br>Fuel type : "+ftype;
        r_btn.setAttribute("data-target","#rmv-vehicle");

    }else{
        r_btn.setAttribute("data-target","#info-modal");
    }
}

function removeOfficer(){
    var r_btn = document.getElementById("remove-officer");
    var selected_row = document.getElementsByClassName('selectedd');

    if( selected_row.item('tr') != null){
        var selected_row = document.getElementsByClassName("selectedd");
        var td_elements = selected_row[0].getElementsByTagName("td");

        var id = selected_row.item('tr').id;

        document.getElementById("r_o_id").value = id;
        r_btn.setAttribute("data-target","#rmv-officer");

    }else{
        r_btn.setAttribute("data-target","#info-modal");
    }
}

function removeDriver(){
    var r_btn = document.getElementById("remove-driver");
    var selected_row = document.getElementsByClassName('selectedd');

    if( selected_row.item('tr') != null){
        var selected_row = document.getElementsByClassName("selectedd");
        var td_elements = selected_row[0].getElementsByTagName("td");

        var id = selected_row.item('tr').id;

        document.getElementById("r_d_id").value = id;
        r_btn.setAttribute("data-target","#rmv-driver");

    }else{
        r_btn.setAttribute("data-target","#info-modal");
    }
}

function viewStat(caller){

    var json_string="";
    if(caller == 'vehicle'){

        var selected_row = document.getElementsByClassName("selectedd");
        var td_elements = selected_row[0].getElementsByTagName("td");

        var v_class = td_elements[0].innerHTML;
        var lplate =  td_elements[1].innerHTML;
        var make =  td_elements[2].innerHTML;
        var model =  td_elements[3].innerHTML;
        var year =  td_elements[4].innerHTML;
        var ftype =  td_elements[5].innerHTML;

        var v_id = selected_row.item('tr').id;

        document.getElementById("selected-row-id").val = v_id;
        document.getElementById("selected-vehicle-stat-summary").val = "vehicle="+ make+" "+ v_class+" "+lplate;

        var url = "http://localhost/FTApplicationServer/requestHandler.php?method=vehicle-stat&vehicle_id="+v_id;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var jo = JSON.parse(xhttp.responseText);
                document.getElementById("selected-vehicle-stat-summary").val += "&fd=" + jo["fav_driver"]+"&bfc="+jo["best_fuel_consumption"];
                var stat = "<b>Last trip</b> <br> distance : " + jo["ls_t_length"]+"km<br>date : "+ jo["ls_t_date"]+"<br>description :"+ jo["ls_t_description"]+"<br>-------------------";
                stat += "<br><b>Longest trip</b> <br> distance : " + jo["lg_t_length"]+"km<br>date : "+ jo["lg_t_date"]+"<br>description :"+ jo["lg_t_description"]+"<br>-------------------";
                stat += "<br><b>Shortest trip</b> <br> distance : " + jo["sh_t_length"]+"km<br>date : "+ jo["sh_t_date"]+"<br>description :"+ jo["sh_t_description"];

                var b_d_fc = "Favourite driver : " + jo["fav_driver"] + "<br> Best fuel consumption : "+jo["best_fuel_consumption"]+" kilometers per liter";

                document.getElementById("vehicle_stat_stat").innerHTML = stat;
                document.getElementById("best-driver-fc").innerHTML = b_d_fc;
            }
        };
        xhttp.open("GET",url,true);
        xhttp.send();

        var e_btn = document.getElementsByClassName("view-stat");
        e_btn[0].setAttribute("data-target","#vehicle-stat");

        var p = document.getElementById("vehicle-summary");
        p.innerHTML = "Class : "+v_class+"<br>Licence plate : "+lplate+"<br>Make : "+make+"<br>Model : "+model+"<br>Year : "+year+"<br>Fuel type : "+ftype;

    }
    else if(caller == 'driver'){

    }
}

function editOfficer(){
    var e_btn = document.getElementById("edit-officer");
    var selected_row = document.getElementsByClassName('selectedd');

    if( selected_row.item('tr') != null){
        var td_elements = selected_row[0].getElementsByTagName("td");

        var id = selected_row.item('tr').id;

        var officer_id = td_elements[0].innerHTML;
        var f_name =  td_elements[1].innerHTML;
        var l_name =  td_elements[2].innerHTML;
        var address =  td_elements[3].innerHTML;
        var contact_no =  td_elements[4].innerHTML;
        var gender =  td_elements[5].innerHTML;
        var nic = td_elements[6].innerHTML;

        document.getElementById('e_o_fname').value = f_name;
        document.getElementById('e_o_lname').value = l_name;
        document.getElementById('e_o_address').value = address;
        document.getElementById('e_o_contact_no').value = contact_no;
        document.getElementById('e_o_gender').value = gender;
        document.getElementById('o_id').value = id;
        document.getElementById('e_o_nic').value = nic;
        document.getElementById('e_o_officer_id').value = officer_id;

        e_btn.setAttribute("data-target","#edit-officer-modal");

    }else{
        e_btn.setAttribute("data-target","#info-modal");
    }
}

function editDriver(){
    var e_btn = document.getElementById("edit-driver");
    var selected_row = document.getElementsByClassName('selectedd');

    if( selected_row.item('tr') != null){
        var td_elements = selected_row[0].getElementsByTagName("td");

        var id = selected_row.item('tr').id;

        var driver_id = td_elements[0].innerHTML;
        var f_name =  td_elements[1].innerHTML;
        var l_name =  td_elements[2].innerHTML;
        var address =  td_elements[3].innerHTML;
        var contact_no =  td_elements[4].innerHTML;
        var gender =  td_elements[5].innerHTML;
        var nic = td_elements[6].innerHTML;
        var licence_no = td_elements[7].innerHTML;

        document.getElementById('e_d_fname').value = f_name;
        document.getElementById('e_d_lname').value = l_name;
        document.getElementById('e_d_address').value = address;
        document.getElementById('e_d_contact_no').value = contact_no;
        document.getElementById('e_d_gender').value = gender;
        document.getElementById('e_d_id').value = id;
        document.getElementById('e_d_nic').value = nic;
        document.getElementById('e_d_driver_id').value = driver_id;
        document.getElementById('e_d_licence_no').value = licence_no;

        e_btn.setAttribute("data-target","#edit-driver-modal");

    }else{
        e_btn.setAttribute("data-target","#info-modal");
    }
}
