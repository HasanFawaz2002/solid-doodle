let div1 = document.querySelector(".rating1");
let div2 = document.querySelector(".rating2");
let div3 = document.querySelector(".rating3");
let container = document.getElementById("container");
let containerText = document.createTextNode("<div>Thank You!</div><br><div>Feedback : Unhappy</div><br><div>We'll use your feedback to improve our customer support</div>")
let select ="";
$(document).ready(function () {
    $("#div1").click(function () {
        $(this).attr("id", "ratings1");
        $("#ratings2").attr("id", "div2");
        $("#ratings3").attr("id", "div3");
        select="a";
    });
    $("#div2").click(function () { 
        $(this).attr("id", "ratings2");
        $("#ratings1").attr("id", "div1");
        $("#ratings3").attr("id", "div3"); 
        select ="b"   
    });
    $("#div3").click(function () { 
        $(this).attr("id", "ratings3")
        $("#ratings1").attr("id", "div1");
        $("#ratings2").attr("id", "div2");
        select = "c" 
    }); 
    
    $("#btn").click(function () { 
        if (select ==="a") {
            container.innerHTML=`<div><strong>Thank You!</strong></div><br>
            <div>Feedback : Unhappy</div><br>
            <div>We'll use your feedback to improve our customer support</div>`
        }if (select ==="b") {
            container.innerHTML=`<div><strong>Thank You!</strong></div><br>
            <div>Feedback : Neutral</div><br>
            <div>We'll use your feedback to improve our customer support</div>`
        }if (select ==="c") {
            container.innerHTML=`<div><strong>Thank You!</strong></div><br>
            <div>Feedback : satisfy</div><br>
            <div>We'll use your feedback to improve our customer support</div>`
        } 
    });

});