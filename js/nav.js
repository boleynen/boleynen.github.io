n=0;

function showNav(){
    var hamburger = document.querySelector(".hamburger");
    var navLinks = document.querySelector("#menuLinks");
    hamburger.classList.toggle("is-active");
    if(n==0){
        n++;
        navLinks.setAttribute("class", "slide-bottom");
        if(navLinks.classList.contains("slide-top")){
            navLinks.removeAttribute("class", "slide-top");
        }
    }else if(n==1){
        n--;
        if(navLinks.classList.contains("slide-botom")){
            navLinks.removeAttribute("class", "slide-bottom");
        }
        navLinks.setAttribute("class", "slide-top");
    }
}

