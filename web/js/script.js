jQuery(document).ready(function(){

    $("._user_edit").click(function(){
        var key = $(this).data('key');
        window.location.href = '/admin/editUser/' + key;
    });

    $("._user_delete").click(function(){
        var key = $(this).data('key');
        window.location.href = '/admin/deleteUser/' + key;
    });
    $("._user_add").click(function(){
        window.location.href = '/admin/addUser/';
    });

    $("._user_cancel").click(function(){
        window.location.href = '/admin';
    });

});
