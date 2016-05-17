/**
 * Created by bmCSoft on 2016-05-17.
 */


function showVStatInDetail(){
    var url = "../controller/controller.php?path=chart";
    openURL(url);
}

function openURL(url){
    var win = window.open(url, '_blank');
    win.focus();
}