var UserID;
var UserNama;
var UserLevel;

$(document).ready(function(){
    
    UserID = $.cookie("UserID");
    UserNama = $.cookie("UserNama");
    UserLevel = $.cookie("UserLevel");
    
    $(".MainMenu").css("height",$(window).height());
    
    $(".LOGOUTBTN").click(function(){
        $.getJSON('ws/ws.php?app=warungnasi&module=login&action=logout', function(data) {
           window.location.href = "index.php";    
        });
    });
    
    console.log(UserNama);
    $(".USERNama").text(UserNama);
    if(UserLevel == 2){
        $(".MainMenu_ListMenuBtn").css("display","none");
        $(".USERLevel").text("Kasir");
    }else{
        $(".USERLevel").text("Administrator");
    }
});