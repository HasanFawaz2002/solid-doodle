const nav =document.querySelector(".navbar");
            let lastScrollY = window.scrollY;
            window.addEventListener("scroll",()=>
            {
                if (lastScrollY<window.scrollY )
                {
                    nav.classList.add("nav--up")
                    console.log(window.scrollY)
                }

                else{
                    nav.classList.remove("nav--up")
                }
                

            
            lastScrollY=window.screenY;
            })
const logo = document.querySelector(".Logo");
            let lastScrollY1=window.scrollY;
            window.addEventListener("scroll",()=>{

                if (lastScrollY1<window.scrollY )
                {
                    logo.classList.add("Logo--hide")
                }

                else {
                    logo.classList.remove("Logo--hide")
                }
                lastScrollY1=window.screenY;
            })
window.addEventListener('scroll',reveal);
function reveal(){
var reveals =document.querySelectorAll('.reveal')
for(var i=0 ; i<reveals.length ; i++){
var windowheight = window.innerHeight;
var revealtop = reveals[i].getBoundingClientRect().top;
revealpoint =150 ;
if(revealtop < windowheight - revealpoint){
    reveals[i].classList.add("active");
                }
else {
    reveals[i].classList.remove("active");
                }
            }
            }

