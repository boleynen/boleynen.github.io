$(document).ready(function(){
    var phone1 = $("#art1img");
    var phone2 = $("#art2img");
    var phone3 = $("#art3img");
    var phone4 = $("#art4img");


    if ($(window).width() > 1000) {
        $("#logo-top").attr("src","../assets/img/gardenlog/logo-square.png");
        $("#logo-top").attr("class","logo-web");

        phone1.attr("src", "assets/img/gardenlog/screen-1.png");
        phone2.attr("src", "assets/img/gardenlog/screen-2.png");
        phone3.attr("src", "assets/img/gardenlog/screen-3.png");
        phone4.attr("src", "assets/img/gardenlog/screen-4.png");
     }
     else {
        $("#logo-top").attr("src","../assets/img/gardenlog/logo-white.png");

        phone1.attr("src", "assets/img/gardenlog/screen-1-mobiel.png");
        phone2.attr("src", "assets/img/gardenlog/screen-2-mobiel.png");
        phone3.attr("src", "assets/img/gardenlog/screen-3-mobiel.png");
        phone4.attr("src", "assets/img/gardenlog/screen-4-mobiel.png");
        

     }
    console.log("document is ready");

    var hamburger = $("#nav-hamburger");
    var clicked = false;
    var links = $(".hamburger-links");

    hamburger.on("click", function(){
        

         links.animate({
            height: 'toggle'
          });

         if(clicked == false){
            clicked = true;
        }else{
            clicked = false;
        }

    });

    var navitems = $("li a");
    navitems.on("click", function(){
        links.animate({
            height: 'toggle'
          });
    });

    $(document).ready(function(){
        $( "a.scrollLink" ).click(function( event ) {
            event.preventDefault();
            $("html, body").animate({ scrollTop: $($(this).attr("href")).offset().top }, 500);
        });
    });

    $( window ).resize(function(){
        

        if ($(window).width() > 1000) {
            $("#logo-top").attr("src","assets/img/gardenlog/logo-square.png");
            $("#logo-top").attr("class","logo-web");

            phone1.attr("src", "assets/img/gardenlog/screen-1.png");
            phone2.attr("src", "assets/img/gardenlog/screen-2.png");
            phone3.attr("src", "assets/img/gardenlog/screen-3.png");
            phone4.attr("src", "assets/img/gardenlog/screen-4.png");
         }
         else {
            $("#logo-top").attr("src","assets/img/gardenlog/logo-white.png");

            phone1.attr("src", "assets/img/gardenlog/screen-1-mobiel.png");
            phone2.attr("src", "assets/img/gardenlog/screen-2-mobiel.png");
            phone3.attr("src", "assets/img/gardenlog/screen-3-mobiel.png");
            phone4.attr("src", "assets/img/gardenlog/screen-4-mobiel.png");
            

         }
    });

    // $(function () {
    //     $(document).scroll(function () {
    //         var nav = $(".navbar");

    //         nav.toggleClass('scrolled', $(this).scrollTop() > nav.height());

    //       });
    //   });

      $(document).on("scroll", function(){
        var nav = $(".navbar");
        // var logo = $("#logo-top");
		if($(document).scrollTop() >= 200){
          nav.addClass("scrolled");
        //   logo.addClass("scrolled-logo");

		}
		else if($(document).scrollTop() <= 200)
		{
            nav.removeClass("scrolled");
            // logo.removeClass("scrolled-logo");
		}
    });

    
    

});