/**
 * Created by karen on 2/3/2016.
 */
jQuery.noConflict();
function recaptchaCallback() {
    jQuery('#unsubscribe').removeAttr('disabled');
    jQuery('#send_message').removeAttr('disabled');
    jQuery('.messages').html('');
    jQuery('.g-recaptcha').css('border','');
}
function closePop(){
    jQuery('.popup_body').fadeOut();
    jQuery('.popup_bg').fadeOut();
}


jQuery(document).ready(function( $ ) {

    $('ul.nav li.dropdown').hover(function() {
        if(!$('.navbar-toggle').is(':visible')) {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
        }
    }, function() {
        if(!$('.navbar-toggle').is(':visible')) {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
        }
    });

    $(".infinite-content").infinitescroll({
        navSelector: ".nav-links",
        nextSelector: ".nav-links a:first",
        itemSelector: ".infinite-post",
        errorCallback: function(){ $(".inf-more-but").css("display", "none") }
    });
    $(window).unbind(".infscr");
    $(".inf-more-but").click(function(){
        $(".infinite-content").infinitescroll("retrieve");
        return false;
    });
    $(window).load(function(){
        autoheight();
        if ($(".nav-links a").length) {
            $(".inf-more-but").css("display","inline-block");
        } else {
            $(".inf-more-but").css("display","none");
        }
    });

    $(window).on('resize', function(){
        autoheight();
    });

    function autoheight() {
        var numItems1 = $('.col1 .infinite-post').length;
        var numItems2 = $('.col2 .infinite-post').length;
        var numItems3 = $('.col3 .infinite-post').length;

        var col1 = $('.col1').height();
        var col2 = $('.col2').height();
        var col3 = $('.col3').height();
        if(numItems1>numItems2 && numItems1>numItems3){

            //console.log(col1+','+col2+','+col3);
            var max_height = col2;

            if ((col3 - max_height) > 0) {
                max_height = col3;
            }
            var dif1 = max_height - col1;
            var dif2 = max_height - col2;
            var dif3 = max_height - col3;
            //console.log(dif1+','+dif2+','+dif3);
            var last_div1 = $('.col1 .infinite-post').last();
            var last_div2 = $('.col2 .infinite-post').last();
            var last_div3 = $('.col3 .infinite-post').last();
            var height1 = last_div1.height();
            var height2 = last_div2.height();
            var height3 = last_div3.height();
            if ((numItems1 + numItems2 + numItems3) <= 3 || (numItems1 == numItems2 && numItems2 == numItems3)) {
                last_div1.find('.one_blog').css('height', (height1 + dif1) + 'px');
                last_div2.find('.one_blog').css('height', (height2 + dif2) + 'px');
                last_div3.find('.one_blog').css('height', (height3 + dif3) + 'px');
            }
            else {


                    last_div2.find('.one_blog').css('height', (height2 + dif2) + 'px');
                    last_div3.find('.one_blog').css('height', (height3 + dif3) + 'px');


            }
        }
        else {
            if ((numItems1 == numItems2 || numItems2 == numItems3 || numItems1 == numItems3) || (numItems1 + numItems2 + numItems3) <= 3) {

                var col1 = $('.col1').height();
                var col2 = $('.col2').height();
                var col3 = $('.col3').height();
                //console.log(col1+','+col2+','+col3);
                var max_height = col1;
                if ((col2 - max_height) > 0) {
                    max_height = col2;
                }
                if ((col3 - max_height) > 0) {
                    max_height = col3;
                }
                var dif1 = max_height - col1;
                var dif2 = max_height - col2;
                var dif3 = max_height - col3;
                //console.log(dif1+','+dif2+','+dif3);
                var last_div1 = $('.col1 .infinite-post').last();
                var last_div2 = $('.col2 .infinite-post').last();
                var last_div3 = $('.col3 .infinite-post').last();
                var height1 = last_div1.height();
                var height2 = last_div2.height();
                var height3 = last_div3.height();
                if ((numItems1 + numItems2 + numItems3) <= 3 || (numItems1 == numItems2 && numItems2 == numItems3)) {
                    last_div1.find('.one_blog').css('height', (height1 + dif1) + 'px');
                    last_div2.find('.one_blog').css('height', (height2 + dif2) + 'px');
                    last_div3.find('.one_blog').css('height', (height3 + dif3) + 'px');
                }
                else {
                    if (numItems1 == numItems2) {
                        last_div1.find('.one_blog').css('height', (height1 + dif1) + 'px');
                        last_div2.find('.one_blog').css('height', (height2 + dif2) + 'px');
                    }
                    if (numItems2 == numItems3) {
                        last_div2.find('.one_blog').css('height', (height2 + dif2) + 'px');
                        last_div3.find('.one_blog').css('height', (height3 + dif3) + 'px');
                    }
                    if (numItems1 == numItems3) {
                        last_div1.find('.one_blog').css('height', (height1 + dif1) + 'px');
                        last_div3.find('.one_blog').css('height', (height3 + dif3) + 'px');
                    }
                }
            }
        }
    }

    function formatCurrency(total, strict) {
        var res = parseFloat(total).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString() ;
        if(strict){
            return res;
        }
        else{
            return res.replace('.00', '');
        }

    }

    $(function () {
        var years=$("#howlong").val();
        var year=3;
        var borrow=10000;
        if($('body').hasClass('page-template-cars') || $('body').hasClass('single-cars')){
            var year=$('input#month').val()/12;
            var borrow=$('input#car_price').val();
        }
        $("#slider-1").slider({
            range: 'min',
            min: 500,
            max: 30000,
            value: borrow,
            step: 500,
            slide: function (event, ui) {
                $(".calculator span.borrow").text(formatCurrency(ui.value,false));
                $("#borrow").val(ui.value);
                $('a#apply_link').attr('href','/apply?form%5Bloan.amount%5D='+calc_link(ui.value));
                pay_borrow();
            },
            create: function (event, ui) {
                var v = $(this).slider('value');
                $(".calculator span.borrow").text(formatCurrency(v,false));
                $("#borrow").val(v);
                $('a#apply_link').attr('href','/apply?form%5Bloan.amount%5D='+calc_link(v));
            }
        });
        $("#slider-2").slider({
            range: 'min',
            min: 1,
            max: years,
            value: year,
            step: 1,
            slide: function (event, ui) {
                $("#years").val(ui.value);
                pay_borrow();
            },
            create: function (event, ui) {
                var v = $(this).slider('value');
                $(".calculator span.years").text(v);
                $("#years").val(v);
            }
        });

        $('ul.howlong li a').click(function (e) {
            e.preventDefault();
            var y=$(this).attr('data-years');
            $("#years").val(y);
            $("#slider-2").slider('value',y);
            pay_borrow();
        })

        pay_borrow();
        function calc_link(ammount){
            // if(ammount>1000 && ammount<=2000) return 2000;
            // if(ammount>2000 && ammount<=3000) return 3000;
            // if(ammount>3000 && ammount<=4000) return 4000;
            // if(ammount>4000 && ammount<=5000) return 5000;
            // if(ammount>5000 && ammount<=10000) return 10000;
            // if(ammount>10000 && ammount<=15000) return 15000;
            // if(ammount>15000 && ammount<=20000) return 20000;
            // if(ammount>20000 && ammount<=25000) return 25000;
            // if(ammount>25000 && ammount<=30000) return 30000;
            return ammount;
        }
        function pay_borrow(){
            var rate=$("span#percent").text();
            var borrow=$("#borrow").val();
            var year=$("#years").val();
            if(year==1){
                $('span#year_word').text('year');
            }
            else{
                $('span#year_word').text('years');
            }
            var month=year*12;
            var j = rate/100/12;
            var PM = borrow*j/(1 - Math.pow((1 + j), (-1*month)));
            var total=PM*month;
            var cost=total-borrow;

            $('span#repayment').text(formatCurrency(total, true));
            $('span#cost').text(formatCurrency(cost, true));
            $('span#money_pay').text(formatCurrency(PM, true));
            $('span#m_pay').text(month);
            $(".calculator span.years").text(year);

            $('ul.howlong li a').removeClass('active');
            $('ul.howlong li a').off('hover');
            $('ul.howlong li a[data-years="'+year+'"]').addClass('active');
        }



    });


    function validateEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    function validateMobile(mob) {
        mob = mob.replace('/-/g', '');
        mob = mob.replace('/ /g', '');
        mob = mob.replace('/+/g', '');
        var regex = /^(\(?07\d{9}\)?)$/;
        return regex.test(mob);
    }
    function validateUKMobile(mob) {
        mob = mob.replace('/-/g', '');
        mob = mob.replace('/ /g', '');
        mob = mob.replace('/+/g', '');
        var regex = /^(?:(?:\(?(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?(?:\(?0\)?[\s-]?)?)|(?:\(?0))(?:(?:\d{5}\)?[\s-]?\d{4,5})|(?:\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3}))|(?:\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4})|(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}))(?:[\s-]?(?:x|ext\.?|\#)\d{3,4})?$/;
        return regex.test(mob);
    }
    $('#email').on('change', function (e)  {
        var email=$.trim($('#email').val());
        if(!validateEmail(email)){
            $('.messages').html('<p class="err" style="color: red; text-align: center;">You have entered wrong email format. Please try again.</p>');
            $('#unsubscribe').attr('disabled','disabled');
            $('#send_message').attr('disabled','disabled');
            $('#email').css('border','2px solid red');
        }
        else{
            $('#unsubscribe').removeAttr('disabled');
            $('#send_message').removeAttr('disabled');
            $('#email').css('border','');
            $('.messages').html('');
        }
    });
    $('#phone').on('change', function (e)  {
        var phone=$.trim($('#phone').val());
        if(!validateMobile(phone)){
            $('.messages').html('<p class="err" style="color: red; text-align: center;">You have entered wrong phone format. Please try again.</p>');
            $('#unsubscribe').attr('disabled','disabled');
            $('#send_message').removeAttr('disabled');
            $('#phone').css('border','2px solid red');
        }
        else{
            $('#unsubscribe').removeAttr('disabled');
            $('#send_message').removeAttr('disabled');
            $('#phone').css('border','');
            $('.messages').html('');
        }
    });
    $('#ukphone').on('change', function (e)  {
        var phone=$.trim($('#ukphone').val());
        if(!validateUKMobile(phone)){
            $('.messages').html('<p class="err" style="color: red; text-align: center;">You have entered wrong phone format. Please try again.</p>');
            $('#unsubscribe').attr('disabled','disabled');
            $('#send_message').removeAttr('disabled');
            $('#ukphone').css('border','2px solid red');
        }
        else{
            $('#unsubscribe').removeAttr('disabled');
            $('#send_message').removeAttr('disabled');
            $('#ukphone').css('border','');
            $('.messages').html('');
        }
    });
    var working=false;
    var pos=$('.messages').offset();

    $('#optout').on('submit', function(e) {
        e.preventDefault();
        var image = '<img src="' + dekascript_object.img + '" alt="Loading ..." />';
        var response = $('#g-recaptcha-response').val();
        var phone=$.trim($('#phone').val());
        var email=$.trim($('#email').val());
        if(phone.length!=0 && email.length!=0 && response.length!=0 && !working){
            working=true;
            var data = {
                action: 'optout',
                security: dekascript_object.nonce,
                phone : phone,
                email : email,
                resp: response
            };
            $('#button_wrapper').html(image);
            jQuery.post(dekascript_object.ajax_url, data, function(msg) {
                $('#button_wrapper').html("<button class='btn btn-primary' id='unsubscribe' type='submit'>Unsubscribe</button>");
                working=false;
                $('.messages').html('');
                if(msg) {
                    var data = JSON.parse(msg);
                    if(data.status=='success'){
                        $('#all_content').html('<p style="text-align: center;">'+data.message+'</p>');

                    }
                    else{
                        $('.messages').append('<p class="err" style="color: red; text-align: center;">'+data.message+'</p>');
                        grecaptcha.reset();
                    }
                }
                else{
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Unsubscribe did not go through. Please try again.</p>');
                }
                $('html, body').animate({ scrollTop: pos.top-50 }, 'fast');
                grecaptcha.reset();
            })
            .fail(function() {
                $('.messages').html('<p class="err" style="color: red; text-align: center;">Unsubscribe did not go through. Please try again.</p>');
                $('#button_wrapper').html("<button class='btn btn-primary' id='unsubscribe' type='submit'>Unsubscribe</button>");
                working=false;
                $('html, body').animate({ scrollTop: pos.top-50 }, 'fast');
                grecaptcha.reset();
            })

        }
        else{
            $('#email').css('border','');
            $('#phone').css('border','');
            $('.g-recaptcha').css('border','');
            if(phone.length==0 && email.length==0){
                $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, Mobile and Email fields  can not be empty. Please try again.</p>');
                $('#email').css('border','2px solid red');
                $('#phone').css('border','2px solid red');
            }
            else{
                if(response.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Are you a robot?</p>');
                    $('.rc-anchor-light').css('border','2px solid red');
                }
                if(phone.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, Mobile field  can not be empty. Please try again.</p>');
                    $('#phone').css('border','2px solid red');
                }
                if(email.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, Email field  can not be empty. Please try again.</p>');
                    $('#email').css('border','2px solid red');
                }
            }
            $('html, body').animate({ scrollTop: pos.top-50 }, 'fast');
            grecaptcha.reset();
        }
    });
    $('#contact').on('submit', function(e) {

        e.preventDefault();
        var image = '<img src="' + dekascript_object.img + '" alt="Loading ..." />';
        var response = $('#g-recaptcha-response').val();
        var name=$.trim($('#name').val());
        var email=$.trim($('#email').val());
        var message=$.trim($('#message').val());
        var subj=$.trim($('#subj').val());
        if(message.length!=0 && subj.length!=0  && name.length!=0 && email.length!=0 && response.length!=0 && !working){
            working=true;
            var data = {
                action: 'contacts',
                security: dekascript_object.nonce,
                name : name,
                subj : subj,
                email : email,
                message : message,
                resp: response
            };
            $('#button_wrapper').html(image);
            jQuery.post(dekascript_object.ajax_url, data, function(msg) {
                $('#button_wrapper').html("<button class='btn btn-primary' id='send_message' type='submit'>Send Message</button>");
                working=false;
                $('.messages').html('');
                if(msg) {
                    var data = JSON.parse(msg);
                    if(data.status=='success'){
                        $('#all_content').html('<p style="text-align: center;">'+data.message+'</p>');

                    }
                    else{
                        $('.messages').append('<p class="err" style="color: red; text-align: center;">'+data.message+'</p>');
                        grecaptcha.reset();
                    }
                }
                else{
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Message did not go through. Please try again.</p>');
                }
                $('html, body').animate({ scrollTop: pos.top-50 }, 'fast');
                grecaptcha.reset();
            })
                .fail(function() {
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Message did not go through. Please try again.</p>');
                    $('#button_wrapper').html("<button class='btn btn-primary' id='send_message' type='submit'>Send Message</button>");
                    working=false;
                    $('html, body').animate({ scrollTop: pos.top-50 }, 'fast');
                    grecaptcha.reset();
                })

        }
        else{
            $('#email').css('border','');
            $('#subj').css('border','');
            $('#name').css('border','');
            $('#message').css('border','');
            $('.g-recaptcha').css('border','');
            if(message.length==0 && email.length==0 && name.length==0){
                $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, fields  can not be empty. Please try again.</p>');
                $('#email').css('border','2px solid red');
                $('#name').css('border','2px solid red');
                $('#message').css('border','2px solid red');
                $('#subj').css('border','2px solid red');
            }
            else{
                if(response.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Are you a robot?</p>');
                    $('.rc-anchor-light').css('border','2px solid red');
                }
                if(name.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, Name field  can not be empty. Please try again.</p>');
                    $('#name').css('border','2px solid red');
                }
                if(email.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, Email field  can not be empty. Please try again.</p>');
                    $('#email').css('border','2px solid red');
                }
                if(message.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, Message field  can not be empty. Please try again.</p>');
                    $('#message').css('border','2px solid red');
                }
                if(subj.length==0){
                    $('.messages').html('<p class="err" style="color: red; text-align: center;">Sorry, Subject field  can not be empty. Please try again.</p>');
                    $('#subj').css('border','2px solid red');
                }

            }

            $('html, body').animate({ scrollTop: pos.top-50 }, 'fast');
            grecaptcha.reset();
        }
    });

    function scaleCaptcha() {
        var reCaptchaWidth = 304;
        var containerWidth = $('#email').outerWidth();

        if(reCaptchaWidth > containerWidth) {
            var captchaScale = containerWidth / reCaptchaWidth;
            $('.g-recaptcha').css({
                'transform':'scale('+captchaScale+')'
            });
        }
    }

    scaleCaptcha();
    $(window).on('resize', function(){
        scaleCaptcha();
    });

});