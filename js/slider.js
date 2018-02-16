/**
 * Created by karen on 2/3/2016.
 */
jQuery(document).ready(function($){
    function slide(i,count,duration, timeout){
        setTimeout(function(){
            jQuery('#slideshow .trending-post').each(function(){
                if(jQuery(this).hasClass('active')){
                    var curimg=jQuery(this);
                    curimg.removeClass('active');
                    var cur_num=curimg.attr('data-num');
                    $('a.control_dot[data-num='+cur_num+']').removeClass('active');
                    if(i<count)var nextimg=curimg.next();
                    else var nextimg=jQuery('#slideshow .trending-post').first();
                    curimg.animate({opacity:0}, duration);
                    nextimg.animate({opacity:1}, duration,function(){
                        nextimg.addClass('active');
                        cur_num=nextimg.attr('data-num');
                        $('a.control_dot[data-num='+cur_num+']').addClass('active');
                        i++;
                        if(i>count)i=1;
                        slide(i, count ,duration, timeout);
                    });
                }

            });

        }, timeout);
    };
    var i=1;
    var count = jQuery('#slideshow').find('.trending-post').length;
    var duration=150;
    var timeout=3000;
    // var height_div=275;
    // $('.trending-post').each(function () {
    //     if($(this).height()>height_div){
    //         height_div=$(this).height();
    //     }
    // })
    // $('.trending').css('height',height_div+'px');
    slide(i, count ,duration, timeout);
})