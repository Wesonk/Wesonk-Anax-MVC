/**
 * Created by wictorkanerva1 on 2014-09-25.
 */
$(document).ready(function(){
    $("#toggle").hide();
    $("textarea[name='content']").focus(function(){
        $("#toggle").slideDown("fast");
    });
});
