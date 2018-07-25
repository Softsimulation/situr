$(document).ready(function(){
    
    $('.nav-bar nav>ul>li>a').on('click',function(e){
        var submenu = $(this).parent();
        if (submenu.find('ul').length > 0) {
            e.preventDefault();
        }
        if($(this).attr("aria-expanded") == "false"){
            $('.nav-bar nav>ul>li a[aria-expanded=true]').attr("aria-expanded", "false");
            $(this).attr("aria-expanded", "true");
        }else{
            $(this).attr("aria-expanded", "false");
        }
        if (!submenu.hasClass('in')) {
            $('.nav-bar nav>ul>li').removeClass('in');
            
            submenu.addClass('in');
            if(submenu.attr('id')=='buscadorGeneral'){
                $('#buscadorGeneral .form-control').focus();
            }
            return;
        }
        
        submenu.removeClass('in');
    });
    $('.nav-bar nav>ul>li>ul>li>a').on('click', function (e) {
        var submenu = $(this).parent();
        if (submenu.find('ul').length > 0) {
            e.preventDefault();
        }
        if($(this).attr("aria-expanded") == "false"){
            $(this).attr("aria-expanded", "true");
        }else{
            $(this).attr("aria-expanded", "false");
        }
        if (!submenu.hasClass('second-in')) {
            $('.nav-bar nav>ul>li>ul>li').removeClass('second-in');
            
            submenu.addClass('second-in');
            return;
        }
        
        
        submenu.removeClass('second-in');
    });
    $('#navbar-mobile button').on('click', function(){
        var navMain = $('#nav-main');
        if(navMain.hasClass('show')){
            navMain.removeClass('show');
            return;
        }
        navMain.addClass('show');
    });
    (function ($) {
        "use strict";
        $(function () {
            $('a[href*="#"]:not([href="#"])').click(function () {
                if ($(this).hasClass("carousel-control") || $(this).parent().hasClass("in") || $(this).parent().hasClass("second-in") || $(this).attr('data-toggle') != undefined) { return; }
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 500);
                        return false;
                    }
                }
            });
        });
    }(jQuery));
    if (getURLParameters('estamento') != undefined) {
        $("#estamentoUsuario option[value='" + getURLParameters('estamento') + "']").attr("selected", "selected");
        $("#enlaceEstamento-" + getURLParameters('estamento')).addClass('estamentoActivo');
    }
    
});
$(document).mouseup(function(e) 
{
    var container = $("#nav-main>ul>li.in, .nav-bar nav>ul>li.in");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0 && e.target != $('html').get(0)) 
    {
        //container.hide();
        
        $(".nav-bar nav>ul>li.in a[aria-expanded=true]").attr("aria-expanded", "false");
        container.removeClass('in');
        container.find('.second-in').removeClass('second-in');
    }
});
// $(window).scroll(function() {
//   var hT = $('#socialNetworks').offset().top,
//       hH = $('#socialNetworks').outerHeight(),
//       wH = $(window).height(),
//       wS = $(this).scrollTop();
//   if ($(this).scrollTop() > 45){
//       $('#socialNetworks').addClass("fix-right");
//   }else{
//       $('#socialNetworks').removeClass("fix-right");
//   }
// });
function getURLParameters(paramName) {
    var sURL = window.document.URL.toString();
    if (sURL.indexOf("?") > 0) {
        var arrParams = sURL.split("?");
        var arrURLParams = arrParams[1].split("&");
        var arrParamNames = new Array(arrURLParams.length);
        var arrParamValues = new Array(arrURLParams.length);

        var i = 0;
        for (i = 0; i < arrURLParams.length; i++) {
            var sParam = arrURLParams[i].split("=");
            arrParamNames[i] = sParam[0];
            if (sParam[1] != "")
                arrParamValues[i] = unescape(sParam[1]);
            else
                arrParamValues[i] = "No Value";
        }

        for (i = 0; i < arrURLParams.length; i++) {
            if (arrParamNames[i] == paramName) {
                //alert("Parameter:" + arrParamValues[i]);
                return arrParamValues[i];
            }
        }
        return undefined;
    }
}
