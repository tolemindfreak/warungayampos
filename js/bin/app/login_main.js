$(document).ready(function(){
    $(".LOGINBTN").click(function(){
        $.post('ws/ws.php?app=warungnasi&module=login&action=login', 
    		{	username: $(".LoginUsernameInput").val(),
    			password: $(".LoginPasswordInput").val()
    		}, 
    		function(data, textStatus, xhr) {
                if(data == "username salah"){
                    Materialize.toast('Username Tidak Ditemukan !', 3000)
                }else if(data == "password salah"){
                    Materialize.toast('Password Salah !', 3000)
                }else{
                    var DataObj = $.parseJSON(data);
                    $.cookie("UserID", DataObj.username);
                    $.cookie("UserNama", DataObj.nama);
                    $.cookie("UserLevel", DataObj.level);
                    //window.location.href = "index.php?app=pos";
                }
        });
    });
});