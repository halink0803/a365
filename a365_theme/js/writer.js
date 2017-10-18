var $=jQuery.noConflict();
$(document).ready(function() {

    $('.set_up').click(function() {
        $("li").removeClass("li_active");

        $(this).toggleClass('li_active');
    });
	 $('.search em').click(function() {
		  $(".box_search").toggle();
		 
	});
	$('.menu_mobile').click(function() {

		  $(".menu_container").toggleClass('menu_active');
		 
	});
	
	
			$('.list_question p').hide();
            $('.list_question h4:first').addClass('active');
            $('.list_question h4').click(function() {
                $('.active').removeClass('active');
                $('.list_question p').slideUp('normal');
                if($(this).next('.list_question p').is(':hidden') == true) {
                $(this).addClass('active');
                $(this).next('.list_question p').slideDown('normal');
                }
            });
            $('.list_question h4').hover(function(){//over
                $(this).addClass('on');
            },function() {//out
                $(this).removeClass('on');
            });
			 
});