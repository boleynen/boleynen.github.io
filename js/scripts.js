!function(a){"use strict";a('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function(){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var e=a(this.hash);if((e=e.length?e:a("[name="+this.hash.slice(1)+"]")).length)return a("html, body").animate({scrollTop:e.offset().top-70},1e3,"easeInOutExpo"),!1}}),a(".js-scroll-trigger").click(function(){a(".navbar-collapse").collapse("hide")}),a("body").scrollspy({target:"#mainNav",offset:100});var e=function(){a("#mainNav").offset().top>100?a("#mainNav").addClass("navbar-shrink"):a("#mainNav").removeClass("navbar-shrink")},t=a(".btn").click(function(){if("all"==this.id)a("#parent > div").fadeIn(450);else{var e=a("."+this.id).fadeIn(450);a("#parent > div").not(e).hide()}t.removeClass("active"),a(this).addClass("active")});e(),a(window).scroll(e)}(jQuery);