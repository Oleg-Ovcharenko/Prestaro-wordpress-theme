var size={
	width: 960,
	marginTopSmall: 0,
	heightMenuSize: 0, 
	widthMenuSize: 0
};

$(document).ready(function() {
    /* плитки */
    $('#content').masonry({
        itemSelector: '#post'
    });

    /* слайдер */
	$('.flexslider').flexslider({
		animation: 'fade',
		animationLoop: true,
		directionNav: false,
		controlsContainer: '.flexslider',
		slideshow: true,
		slideshowSpeed: 7000,
		animationSpeed: 600,
		touch: true,
		controlNav: false,
		directionNav: true,
		prevText: "<i class=\"fa fa-chevron-left\"></i>",
		nextText: "<i class=\"fa fa-chevron-right\"></i>"
	});

	setValue();
	$('.button_menu').click(function(){
		if(size.width < 1500){
			smallScreenMenu();
		}
		if(size.width > 1500){
			bigScreenMenu();
		}
	});

	sizeFunc();
	$(window).resize(sizeFunc);

    blockquote();
    $("a.wpfp-link").removeAttr("title");
    $('a[href^="#scroll"]').click(function(){
        var target = $(this).attr('href');
        $('html, body').animate({scrollTop: $(target).offset().top}, 1000);
        return false;
    });
});

function sizeFunc(){
	size.width = $(window).width();
	if(size.width < 1500){
		$('#menu').css('top', size.marginTopSmall+'px');
		$('#menu').css('right', 0);
	}
	if(size.width > 1500){
		$('#menu').css('top', 0);
		$('#menu').css('right', '-275px');
	}
}

function smallScreenMenu(){
	var top = $('#menu').css('top');
	top = parseInt(top);
	if(top < 70)
	{
	$('#menu').animate({'top':'70'},300);
	}
	if(top === 70){
		$('#menu').animate({'top': size.marginTopSmall+'px'},300);
	}
}

function bigScreenMenu(){
	var right = $('#menu').css('right');
	right = parseInt(right);
	if(right <= 0)
	{
		$('#menu').animate({'right':'0'},300);
	}
	if(right === 0){
		$('#menu').animate({'right': size.widthMenuSize+'px'},300);
	}
}

function setValue(){
	size.width = $(window).width();

	$('#menu').css('display', 'block');
	size.marginTopSmall = $('#menu').height();
	size.heightMenuSize = parseInt(size.heightMenuSize);
	size.marginTopSmall = (parseInt(size.marginTopSmall) + size.heightMenuSize)*(-1);

	size.widthMenuSize = $('#menu').width();
	size.widthMenuSize = parseInt(size.widthMenuSize + 20)*(-1);

	$('#menu').css('top', size.marginTopSmall+'px');
}

function blockquote(){
    var text = $('blockquote h3').html();
    var date = $('a#post_date').html();
    $("blockquote h3").html(text +"<span>"+ date +"</span>")
}