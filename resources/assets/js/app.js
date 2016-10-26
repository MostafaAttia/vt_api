/**
 * Created by mostafa on 25/10/16.
 */

$(document).ready(function(){

    $('#admins').DataTable();

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

});