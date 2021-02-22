
function getTargetSum(selector) {
    var sum = 0;
    $(selector).each(function () {
        $(this).children(".value").each(function () {
            sum += +$(this).text() || 0;
        });
    });
    return sum;
}
function getInvestorsSum(selector) {
    var sum = 0;
    $(selector).each(function () {
        $(this).children(".investor").each(function () {
            sum += +$(this).text() || 0;
        });
    });
    return sum;
}
function percentage(num, per){
  return (num/100)*per;
}

/* ---- PAGE LOADER ---- */

$(document).ready(function(){
    $('#pageLoader').addClass('pageLoader--hidden');
});

/* ---- TILE FRONT ---- */

$(document).ready(function () {
    $('.tile').each(function(){
        var spantotal = $(this).find('.total')
        var wrap = $(this).find('.tile_financialInfo--donations');
        var total = getTargetSum(wrap);
        var formatter = $.number( total, ' ', ' ', ' '  )

        var target = $(this).find('.status').find('.target');
        var targetvalue = target.text();
        var targetvalueformatter = $.number(targetvalue, ' ', ' ', ' ')

        spantotal.text(formatter);
        target.text(targetvalueformatter);

        var targetPercent = total / targetvalue*100;
        var targetPercentformatter = $.number(targetPercent, 0);

        var percentwrap = $(this).find('.targetPercent');
        percentwrap.text(targetPercentformatter);

        var investors = $(this).find('.tile_financialInfo--donations')
        var investorsum = getInvestorsSum(investors);
        var investorwrap = $(this).find('.investors');
        investorwrap.text(investorsum);

        var statusbar = $(this).find('.tile__statusBar--current');
        statusbar.css('width', targetPercentformatter + '%');

        if(targetPercentformatter >= 100){
            $(this).removeClass('tile--active');
            $(this).addClass('tile--achieved');

            $(this).find('.tile__date').text('Zakończono');
        }
    });
});

/* ---- TILE PANEL ---- */

$(document).ready(function () {
    $('.tilePanel').each(function(){
        var spantotal = $(this).find('.total')
        var wrap = $(this).find('.tilePanel_financialInfo--donations');
        var total = getTargetSum(wrap);
        var formatter = $.number( total, ' ', ' ', ' '  )

        var target = $(this).find('.status').find('.target');
        var targetvalue = target.text();
        var targetvalueformatter = $.number(targetvalue, ' ', ' ', ' ')

        spantotal.text(formatter);
        target.text(targetvalueformatter);

        var targetPercent = total / targetvalue*100;
        var targetPercentformatter = $.number(targetPercent, 0);

        var percentwrap = $(this).find('.targetPercent');
        percentwrap.text(targetPercentformatter);

        var investors = $(this).find('.tilePanel_financialInfo--donations')
        var investorsum = getInvestorsSum(investors);
        var investorwrap = $(this).find('.investors');
        investorwrap.text(investorsum);

        var statusbar = $(this).find('.tilePanel__statusBar--current');
        statusbar.css('width', targetPercentformatter + '%');

        if(targetPercentformatter >= 100){
            $(this).removeClass('tilePanel--active');
            $(this).addClass('tilePanel--achieved');

            $(this).find('.tilePanel__date').text('Zakończono');
        }
    });
});
$(document).ready(function(){
    var investmentPosition = $('#userBase').find('.investmentPosition');

    $(investmentPosition).each(function(){
        var investmentID = $(this).find('.investmentID').text();
        var investmentValue = $(this).find('.investmentValue').text();
        var investmentValueFormatted = $.number(investmentValue, ' ', ' ', ' ')
        var investmentAccepted = $(this).find('.investmentAccepted').text();

        console.log('ID: ' + investmentID + ', Kwota: ' + investmentValue + ', Akceptacja: ' + investmentAccepted);

        var projectSelect = $('.tilePanel[postid="' + investmentID +'"]');

        if(investmentAccepted === 'TAK'){
            projectSelect.addClass('tilePanel--accepted');
            projectSelect.find('.tilePanel__date').text('Zatwierdzona inwestycja');
            projectSelect.find('.requestInfo .value span').text(investmentValueFormatted);
        }else{
            projectSelect.addClass('tilePanel--request');
            projectSelect.find('.tilePanel__date').text('Oczekuje na płatność');
            projectSelect.find('.requestInfo .value span').text(investmentValueFormatted);
        }
    });
});


/* ---- PROJECT FILTER ---- */

$(document).ready(function(){
    var countAll = $('.projectList > .tile').length;
    var countCurrent = $('.projectList > .tile--active').length;
    var countClosed = $('.projectList > .tile--achieved').length;

    $('.catSelect').find('.all').text(countAll);
    $('.catSelect').find('.current').text(countCurrent);
    $('.catSelect').find('.closed').text(countClosed);
});

$(document).on('click', '.catSelect__btn', function(){
    var select = $(this).attr('select');

    if(select == 'all'){
        $('.projectList .tile').show().addClass('visible');
        $('.catSelect').find('.catSelect__btn').removeClass('active');
        $(this).addClass('active');
    }
    if(select == 'current'){
        $('.projectList .tile').hide().removeClass('visible');
        $('.projectList .tile--active').show().addClass('visible');
        $('.catSelect').find('.catSelect__btn').removeClass('active');
        $(this).addClass('active');
    }
    if(select == 'closed'){
        $('.projectList .tile').hide().removeClass('visible');
        $('.projectList .tile--achieved').show().addClass('visible');
        $('.catSelect').find('.catSelect__btn').removeClass('active');
        $(this).addClass('active');
    }

    if($('.projectList').find('article.visible').length < 3){
        $('.projectList').addClass('projectList--little');
    }else{
        $('.projectList').removeClass('projectList--little')
    }
});

/* ---- PROJECT FILTER PANEL ---- */

$(document).ready(function(){
    var countAll = $('.projectList > .tilePanel').length;
    var countRequest = $('.projectList > .tilePanel--request').length;
    var countAccepted = $('.projectList > .tilePanel--accepted').length;

    $('.catSelect').find('.all').text(countAll);
    $('.catSelect').find('.request').text(countRequest);
    $('.catSelect').find('.accepted').text(countAccepted);
});

$(document).on('click', '.catSelect__btn', function(){
    var select = $(this).attr('select');

    if(select == 'all'){
        $('.projectList .tilePanel').show().addClass('visible');
        $('.catSelect').find('.catSelect__btn').removeClass('active');
        $(this).addClass('active');
    }
    if(select == 'request'){
        $('.projectList .tilePanel').hide().removeClass('visible');
        $('.projectList .tilePanel--request').show().addClass('visible');
        $('.catSelect').find('.catSelect__btn').removeClass('active');
        $(this).addClass('active');
    }
    if(select == 'accepted'){
        $('.projectList .tilePanel').hide().removeClass('visible');
        $('.projectList .tilePanel--accepted').show().addClass('visible');
        $('.catSelect').find('.catSelect__btn').removeClass('active');
        $(this).addClass('active');
    }

    if($('.projectList').find('article.visible').length < 3){
        $('.projectList').addClass('projectList--little');
    }else{
        $('.projectList').removeClass('projectList--little')
    }
});

/****** CAROUSELS *******/

$(document).ready(function(){
    $('.projectSliderList').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        variableWidth: true,
        centerMode: true,
        dots: true,
        arrows: true,
    });
});

$(document).ready(function(){
    $('.reviewsSlider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        draggable: false,
        arrows: false,
        dots: false,
        asNavFor: '.reviewsDotsSlider'
    });

    $('.reviewsDotsSlider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        variableWidth: true,
        centerMode: false,
        dots: false,
        arrows: true,
        focusOnSelect: true,
        asNavFor: '.reviewsSlider',
        responsive: [
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: true,
              }
            }
          ]
    });
});

$(document).ready(function(){
    $('.frontReviewsLogo__logoSlider').slick({
        infinite: true,
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        variableWidth: true,
        centerMode: true,
        draggable: false,
        arrows: true,
        dots: false,
        asNavFor: '.frontReviewsLogo__contentSlider'
    });

    $('.frontReviewsLogo__contentSlider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: false,
        centerMode: false,
        draggable: false,
        fade: true,
        dots: false,
        arrows: false,
        asNavFor: '.frontReviewsLogo__logoSlider'
    });
});

$(document).ready(function(){
    $('.projectGallery__list').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: false,
              }
            },
            {
                breakpoint: 767,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: true,
                  arrows: false,
                }
              }
          ]
    });
});

$(document).ready(function(){
    $('.projectInfoSlider').slick({
        dots: true,
        arrows: true,
        prevArrow: '',
        nextArrow: $('.projectInfoSlide__next'),
        infinite: true,
        speed: 800,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        adaptiveHeight: true,
        variableWidth: true,
        responsive: [
            {
              breakpoint: 767,
              settings: {
                variableWidth: false,
                adaptiveHeight: false,
              }
            }
        ]
    });
    // $('.projectInfoSlider').on('swipe', function(event, slick, direction){
    //     $(this).find('.projectInfoSlide').removeClass('ready');
    //     $(this).find('.projectInfoSlide.slick-active').next().addClass('ready');
    //     $(this).find('.projectInfoSlide.slick-active').prev().addClass('ready');
    // });
    
    // $('.projectInfoSlider').on('edge', function(event, slick, direction){
    //     $(this).find('.projectInfoSlide').removeClass('ready');
    //     $(this).find('.projectInfoSlide.slick-active').next().addClass('ready');
    //     $(this).find('.projectInfoSlide.slick-active').prev().addClass('ready');
    // });
    
    // $('.projectInfoSlider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
    //     $(this).find('.projectInfoSlide').removeClass('ready');
    //     $(this).find('.projectInfoSlide.slick-active').next().addClass('ready');
    //     $(this).find('.projectInfoSlide.slick-active').prev().addClass('ready');
    // });
});

/* PROJECT PAGE
----------------- */

$(document).ready(function(){
    if($('body').hasClass('single-projects')){
        $('#masthead').addClass('siteHeader--white');
    }
});

$(document).ready(function(){
    var element = $('.projectStatusTile--toBottom');
    var height = element.height() + 20;

    $(element).css('top', '-' + height + 'px');
});

$(document).ready(function () {
    $('.projectStatusTile').each(function(){
        var spantotal = $(this).find('.total')
        var wrap = $(this).find('.projectStatusTile__database');
        var total = getTargetSum(wrap);
        var formatter = $.number( total, ' ', ' ', ' '  );

        var target = $(this).find('.status').find('.target');
        var targetvalue = target.text();
        var targetvalueformatter = $.number(targetvalue, ' ', ' ', ' ')

        spantotal.text(formatter);
        target.text(targetvalueformatter);

        var targetPercent = total / targetvalue*100;
        var targetPercentformatter = $.number(targetPercent, 0);

        var percentwrap = $(this).find('.targetPercent');
        percentwrap.text(targetPercentformatter);

        var investors = $(this).find('.projectStatusTile__database')
        var investorsum = getInvestorsSum(investors);
        var investorwrap = $(this).find('.investors');
        investorwrap.text(investorsum);

        /* STATUS BAR MOBILE */

        var statusbar = $('.projectSimpleStatus--mobile').find('.projectSimpleStatus__status');
        statusbar.css('top', 'calc(' + targetPercentformatter + '% - 20px)');

        /* STATUS BAR */

        var statusbar = $(this).parent().find('.projectSimpleStatus__status');
        statusbar.css('left', 'calc(' + targetPercentformatter + '% - 20px)');

        var arrowbar = $(this).parent().find('.projectStatusArrow');
        if(targetPercentformatter == 0){
            arrowbar.css('left', 'calc(' + targetPercentformatter + '% - 1px)');
        }

        arrowbar.css('left', targetPercentformatter + '%');

        if(targetPercentformatter >= 100){
            arrowbar.css('left', 'calc(100% - 1px)');
        }
        
        var infobarWidth = $(this).width() / 1.6;

        var cssValue = 'calc(' + targetPercentformatter + '% - ' + infobarWidth + 'px)';
        console.log(infobarWidth);

        if(targetPercentformatter >= 16){
            $(this).css('left', cssValue);
        }
        if(targetPercentformatter >= 84){
            $(this).css('left', 'auto');
            $(this).css('right', '0');
        }

        if(targetPercentformatter >= 15){
            $(this).removeClass('projectStatusTile--maxLeft');
        }
        if(targetPercentformatter >= 84){
            $(this).addClass('projectStatusTile--maxRight');
        }
    });
});
$(document).ready(function () {
    $('.projectInfoSlider__slide').each(function(){
        var number = $(this).find('.projectInfoSlide__dots').attr('count');
        $(this).find('.projectInfoSlide__dots span:nth-child(' + number + ')').addClass('active');
    });
});
$(document).ready(function(){
    $('.projectStatusSteps__step').each(function(){
        var toend = $(this).attr('end');
        var prev = $(this).prev('.projectStatusSteps__step').attr('end');
        if(typeof prev == 'undefined'){
            prev = 0;
        }
        var current = $('.projectSimpleStatus--two').find('.projectStatusTile__info').find('.targetPercent').text();

        var toendNum = parseInt(toend);
        var currentNum = parseInt(current);

        if(currentNum >= toendNum){
            $(this).addClass('projectStatusSteps__step--end');
            $(this).find('.projectStatusSteps__status').find('.current').find('span').text('Zrealizowany')
        }
        if(currentNum < toendNum && currentNum >= prev){
            $(this).addClass('projectStatusSteps__step--current');
            $(this).find('.projectStatusSteps__status').find('.current').find('span').text('W trakcie')
        }
        if(currentNum < toendNum && currentNum < prev){
            $(this).addClass('projectStatusSteps__step--next');
            $(this).find('.projectStatusSteps__status').find('.current').find('span').text('Planowany')
        }
    });
});

/*  filterEngine
---------------- */

$(document).ready(function(){

    /* Dropdown */

    $('.filterRow p img').on('click', function(){
        $('.filterDropdown').removeClass('toggle');

        var dropdown = $(this).parent().parent().find('.dropdown');
        dropdown.addClass('toggle');

        var wrap = $('.projectsFilter__filter');
        $(document).mouseup(function(e){
            if (!wrap.is(e.target) && wrap.has(e.target).length === 0) {
                dropdown.removeClass('toggle');
            }
        });
    });
    // $('.filterRow p .dropdown-show').on('click', function(){
    //     var dropdown = $(this).parent().parent().find('.dropdown');
    //     dropdown.removeClass('toggle');
    //     $(this).addClass('dropdown-hide').removeClass('dropdown-show');
    // });

    /* Największa i najmniejsza cena */

    var minPrice = 99999999999999;
    var maxPrice = 0;
    $('.projectsFilter__database .prices li').each(function(){
        var thisPrice = parseInt($(this).attr('data'));
        if(thisPrice >= maxPrice) {
            maxPrice = thisPrice;
        }
        if(thisPrice <= minPrice) {
            minPrice = thisPrice;
        }
    });

    minPriceFormat = $.number(minPrice, ' ', ' ', ' ');
    maxPriceFormat = $.number(maxPrice, ' ', ' ', ' ');

    var valFrom = $('#valFrom').val(minPriceFormat + ' PLN');
    var valTo = $('#valTo').val(maxPriceFormat + ' PLN');

    /* Suwak ceny */

    $('#slider-range').slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        step: 100000,
        values: [minPrice, maxPrice],
        slide: function(event, ui){
            
            var valueOne = ui.values[0];
            var valueOneFormat = $.number(valueOne, ' ', ' ', ' ');

            var valueTwo = ui.values[1];
            var valueTwoFormat = $.number(valueTwo, ' ', ' ', ' ');

            valFrom.val(valueOneFormat + ' PLN');
            valTo.val(valueTwoFormat + ' PLN');
        }
    })

    /* Wynik wyszukiwania */

    $('#slider-range').on( 'slidestop', function(event, ui){
        var min = ui.values[0];
        var max = ui.values[1];

        $('.projectList').css('opacity', '0.5');

        setTimeout(function(){
        $('.projectList .tile').each(function(){
            var targetPrice = parseInt($(this).attr('targetprice'));

            if(targetPrice > max || targetPrice < min){
                $(this).addClass('price-failed').removeClass('price-correct');
            }else{
                $(this).removeClass('price-failed').addClass('price-correct');
            }
        });

        if ($(".projectList .finded").length == 2){
            $('.projectList').addClass('projectList--twoElements');
        }else{
            $('.projectList').removeClass('projectList--twoElements');
        }

        $('.projectList').css('opacity', '1');

        }, 1000);
    });
});

$(document).ready(function(){

    /* Filtr lokalizacji */

    var checkbox = $('.dropdown__checkbox input'); 

    $(checkbox).on('click', function(){
        $(this).parent().toggleClass('not-checked');
        $(this).parent().toggleClass('in-checked');
    });

    $(checkbox).on('click', function() {
        var selectAddress = $(this).attr('name');
        console.log(selectAddress);

        $('.projectList .tile').each(function() {
            var address = $(this).attr('address');

            if(address !== selectAddress){
                $(this).toggleClass('address-failed');
            }
        });
    });
    $('.in-checked').on('click', function() {
        var selectAddressOff = $(this).find('input').attr('name');

        $('.projectList .tile').each(function() {
            var address = $(this).attr('address');

            if(address == selectAddressOff){
                $(this).show();
            }
        });
    });


    // if ($(".projectList .finded").length == 2){
    //     $('.projectList').addClass('projectList--twoElements');
    // }else{
    //     $('.projectList').removeClass('projectList--twoElements');
    // }
});

/* ---- LOGGED ACTIONS ---- */

$(document).ready(function(){

    if($('body').hasClass('logged-in')){
        var username = $('body').attr('username');
        var logout = $('body').attr('logout');
        var signin = $('#masthead .menu .sign-in a');
        var signup = $('#masthead .menu .sign-up a');

        signin.text(username).addClass('logged').attr('href', 'http://app.waterbridge.pl/');
        signup.text('Wyloguj się').attr('href', logout);

        signin.parent().removeClass('openPopup-login');
        signup.parent().removeClass('openPopup-register');
    }
});

/* ---- FORM POPUP ---- */

$(document).ready(function(){
    $('.openPopup-login').find('a').removeAttr('href');
    $('.openPopup-register').find('a').removeAttr('href');
    var popup = $('#wbPopup');

    $('.openPopup-login').on('click', function(){
        popup.addClass('toggle');
        popup.find('.wbLogin').addClass('active');
        setTimeout(function(){
            popup.find('.wbLogin').addClass('toggle');
        }, 500);
    });

    $('.openPopup-register').on('click', function(){
        popup.addClass('toggle');
        popup.find('.wbRegister').addClass('active');
        setTimeout(function(){
            popup.find('.wbRegister').addClass('toggle');
        }, 500);
    });

    $('.openInvestForm').on('click', function(){
        popup.addClass('toggle');
        popup.find('.wbInvest').addClass('active');
        setTimeout(function(){
            popup.find('.wbInvest').addClass('toggle');
        }, 500);
    });

    $('.wbPopup__close').on('click', function(){
        var formContent = popup.find('.popupFormContent');

        formContent.removeClass('toggle');
        setTimeout(function(){
            popup.removeClass('toggle');
        }, 200);
        setTimeout(function(){
            formContent.removeClass('active');
        }, 500);
    });
});

/* INNER POPUP ACTIONS
------------------------- */

$(document).ready(function(){
    $('.registerInfo__btn').on('click', function(){
        $('.wbLogin').removeClass('toggle')
        setTimeout(function(){
            $('.wbLogin').removeClass('active')
        }, 200);
        setTimeout(function(){
            $('.wbRegister').addClass('active')
        }, 200);
        setTimeout(function(){
            $('.wbRegister').addClass('toggle')
        }, 400);
    });
    $('.loginInfo__btn').on('click', function(){
        $('.wbRegister').removeClass('toggle')
        setTimeout(function(){
            $('.wbRegister').removeClass('active')
        }, 200);
        setTimeout(function(){
            $('.wbLogin').addClass('active')
        }, 200);
        setTimeout(function(){
            $('.wbLogin').addClass('toggle')
        }, 400);
    });
    $('.forgot-pass').on('click', function(){
        $('.wbLogin').removeClass('toggle')
        setTimeout(function(){
            $('.wbLogin').removeClass('active')
        }, 200);
        setTimeout(function(){
            $('.wbPassLost').addClass('active')
        }, 200);
        setTimeout(function(){
            $('.wbPassLost').addClass('toggle')
        }, 400);
    });
});
$(document).ready(function(){
    $('#investValueInputToSend').suffix(" udziałów");
    var userEmail = $('body').attr('email');
    var userID = $('body').attr('userid');
    var userName = $('body').attr('username');
    var projectID = $('.waterbridge--project').attr('projectid');
    var projectName = $('.breadcrumb').find('.projectName').text();

    $('#investFormUserEmail').val(userEmail);
    $('#investFormUserID').val(userID);
    $('#investFormUserName').val(userName);
    $('#investFormProjectID').val(projectID);
    $('#investFormProjectName').val(projectName);

    $('.wbInvest__input--plus').click(function(e){
        e.preventDefault();
        fieldName = $(this).attr('field');
        var currentVal = parseInt($(this).siblings('input[name='+fieldName+']').val());
        if (!isNaN(currentVal)) {
            $(this).siblings('input[name='+fieldName+']').val(currentVal + 1);
        } else {
           $(this).siblings('input[name='+fieldName+']').val(0);
        }
        var valAfter = $(this).siblings('input[name='+fieldName+']').val();
        $('#investValueInputToSend').val(valAfter);
        $('#investValueInputToSend').suffix(" udziałów");

        var calculateWrap = $('.wbInvest__summary .value span');
        var calculation = valAfter * 500;
        var calculationFormatted = $.number(calculation, ' ', ' ', ' ')
        calculateWrap.text(calculationFormatted);
        $('.wpcf7-submit').removeClass('disable');
    });

    $(".wbInvest__input--minus").click(function(e) {
        e.preventDefault();
        fieldName = $(this).attr('field');
        var currentVal = parseInt($(this).siblings('input[name='+fieldName+']').val());
        if (!isNaN(currentVal) && currentVal >= 101) {
            $(this).siblings('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            $(this).siblings('input[name='+fieldName+']').val(100);
        }
        var valAfter = $(this).siblings('input[name='+fieldName+']').val();
        $('#investValueInputToSend').val(valAfter);
        $('#investValueInputToSend').suffix(" udziałów");

        var calculateWrap = $('.wbInvest__summary .value span');
        var calculation = valAfter * 500;
        var calculationFormatted = $.number(calculation, ' ', ' ', ' ')
        calculateWrap.text(calculationFormatted);
        $('.wpcf7-submit').removeClass('disable');
    });
    $('#investValueInputToSend').on('change keyup', function(){
        var currentValue = $(this).val();
        var currentValueNumber = parseInt(currentValue);
        var calculateWrap = $('.wbInvest__summary .value span');

        if(currentValueNumber > 99){
            var calculation = currentValueNumber * 500;
            var calculationFormatted = $.number(calculation, ' ', ' ', ' ')
            calculateWrap.text(calculationFormatted);

            $('.investValueInput').val(currentValue);
            calculateWrap.text(calculationFormatted);
            $('.wpcf7-submit').removeClass('disable');
        }else{
            $('.wpcf7-submit').addClass('disable');
        }
    });
});

/* ---- LOGIN FORM ---- */

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

$(document).ready(function(){
    var param = getUrlParameter('registerStatus');

    if(param == 'success'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbUpdate').addClass('active');
        setTimeout(function(){
            $('.wbPopup').find('.wbUpdate').addClass('toggle');
        }, 500);
    }
});

$(document).ready(function(){
    var checkbox = $('.formCheckbox input');

    $(checkbox).on('click', function(){
        if(checkbox.is(':checked')){
            $(this).parent().addClass('checked');
        }else{
            $(this).parent().removeClass('checked');
        }
    });
});

$(document).ready(function(){
    var param = getUrlParameter('loginStatus');

    if(param == 'failed'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbLogin').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbLogin').addClass('toggle');
        }, 500);
    }
    if(param == 'noLogged'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbLogin').addClass('active');
        setTimeout(function(){
            $('.wbPopup').find('.wbLogin').addClass('toggle');
        }, 500);
    }
});

$(document).ready(function(){
    var chceckmail = getUrlParameter('checkemail');
    var errors = getUrlParameter('errors');
    var password = getUrlParameter('password');

    var login = getUrlParameter('login');
    var key = getUrlParameter('key');

    if(chceckmail == 'confirm'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbPassLost').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbPassLost').addClass('toggle');
            $('.wbPassLost').find('.toChange').hide();
        }, 500);
    }
    if(errors == 'invalid_email'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbPassLost').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbPassLost').addClass('toggle');
            $('.wbPassLost').find('.toChange').hide();
        }, 500);
    }
    if(errors == 'empty_username'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbPassLost').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbPassLost').addClass('toggle');
            $('.wbPassLost').find('.toChange').hide();
        }, 500);
    }
    
    if(login && key){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbNewPass').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbNewPass').addClass('toggle');
        }, 500);
    }
    if(login && key && errors == 'password_reset_empty'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbNewPass').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbNewPass').addClass('toggle');
            $('.wbNewPass').find('.popupTitle').addClass('errorToggle').addClass('errorToggle--empty');
        }, 500);
    }
    if(login && key && errors == 'password_reset_mismatch'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbNewPass').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbNewPass').addClass('toggle');
            $('.wbNewPass').find('.popupTitle').addClass('errorToggle').addClass('errorToggle--notValid');
        }, 500);
    }
    if(password == 'changed'){
        $('.wbPopup').addClass('toggle');
        $('.wbPopup').find('.wbNewPass').addClass('active').addClass('error');
        setTimeout(function(){
            $('.wbPopup').find('.wbNewPass').addClass('toggle');
            $('.wbNewPass').find('.popupTitle').hide();
            $('.wbNewPass').find('.wbNewPass__form').hide();
            $('.wbNewPass').find('.wbNewPass__confirm').addClass('toggle');
        }, 500);
    }
});

/* ---- LOGGED ACTIONS ---- */

$(document).ready(function(){
    var username = $('body').attr('username');
    var logout = $('body').attr('logout');
    var signin = $('#masthead .menu .sign-in a');
    var signup = $('#masthead .menu .sign-up a');

    if($('body').hasClass('logged-in')){
        signin.text(username).removeClass('openPopup-login').addClass('logged').attr('href', 'http://app.waterbridge.pl/');
        signup.text('Wyloguj się').removeClass('openPopup-register').attr('href', logout);
    }
});