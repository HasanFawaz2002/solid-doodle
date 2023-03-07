let email = document.getElementById("exampleInputEmail1");
let pass = document.getElementById("exampleInputPassword1");

$(document).ready(function () {
    $("#exampleInputEmail1").focus();
    $("#btn").click(function (e) { 
        if (email.value==="" ) {
            e.preventDefault();
            $(email).attr("placeholder", "Required");
        }
        if (pass.value==="") {
            e.preventDefault();
            $(pass).attr("placeholder", "Required");
        }
    });
    
});




