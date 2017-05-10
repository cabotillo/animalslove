/**
 * Created by Alberto Cabot Garcia on 10/05/2017.
 */


$(document).ready(function(){
    $("#publicaciones").hide();

    $("#publicaciones").click(function(){
        $("#mascotas").hide();
        $("#publicaciones").show();
    });

    $("#mascotas").click(function(){
        $("#publicaciones").hide();
        $("#mascotas").show();
    });
});


