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
            var btn = $(".selectedd")[0].getElementsByTagName("button");
            btn[0].className="btn btn-sm btn-default disabled";;
            $('.disabled').attr('onclick',null);
            $(this).removeClass('selectedd');
        }
        else {
            if($(".view-stat")[0]){
                var b = $(".view-stat")[0];
                b.className = "btn btn-sm btn-default disabled";
                $('.disabled').attr('onclick',null);

            }
            table.$('tr.selectedd').removeClass('selectedd');
            $(this).addClass('selectedd');
            var btn = $(".selectedd")[0].getElementsByTagName("button");
            btn[0].className="btn btn-sm btn-success view-stat";
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

function viewStat(caller){
    if(caller == 'vehicle'){
        var e_btn = document.getElementsByClassName("view-stat");
        e_btn[0].setAttribute("data-target","#vehicle-stat");

        var selected_row = document.getElementsByClassName("selectedd");
        var td_elements = selected_row[0].getElementsByTagName("td");

        var v_class = td_elements[0].innerHTML;
        var lplate =  td_elements[1].innerHTML;
        var make =  td_elements[2].innerHTML;
        var model =  td_elements[3].innerHTML;
        var year =  td_elements[4].innerHTML;
        var ftype =  td_elements[5].innerHTML;

        var p = document.getElementById("vehicle-summary");
        p.innerHTML = "Class : "+v_class+"<br>Licence plate : "+lplate+"<br>Make : "+make+"<br>Model : "+model+"<br>Year : "+year+"<br>Fuel type : "+ftype;
    }
    else if(caller == 'driver'){
        alert("you are from driver");
    }


}