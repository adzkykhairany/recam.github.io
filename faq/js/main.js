jQuery(document).ready(function($){
	//update these values if you change these breakpoints in the style.css file (or _layout.scss if you use SASS)
	var MqM= 768,
		MqL = 1024;

	var ADUANsSections = $('.cd-ADUAN-group'),
		ADUANTrigger = $('.cd-ADUAN-trigger'),
		ADUANsContainer = $('.cd-ADUAN-items'),
		ADUANsCategoriesContainer = $('.cd-ADUAN-categories'),
		ADUANsCategories = ADUANsCategoriesContainer.find('a'),
		closeADUANsContainer = $('.cd-close-panel');
	
	//select a ADUAN section 
	ADUANsCategories.on('click', function(event){
		event.preventDefault();
		var selectedHref = $(this).attr('href'),
			target= $(selectedHref);
		if( $(window).width() < MqM) {
			ADUANsContainer.scrollTop(0).addClass('slide-in').children('ul').removeClass('selected').end().children(selectedHref).addClass('selected');
			closeADUANsContainer.addClass('move-left');
			$('body').addClass('cd-overlay');
		} else {
	        $('body,html').animate({ 'scrollTop': target.offset().top - 19}, 200); 
		}
	});

	//close ADUAN lateral panel - mobile only
	$('body').bind('click touchstart', function(event){
		if( $(event.target).is('body.cd-overlay') || $(event.target).is('.cd-close-panel')) { 
			closePanel(event);
		}
	});
	ADUANsContainer.on('swiperight', function(event){
		closePanel(event);
	});

	//show ADUAN content clicking on ADUANTrigger
	ADUANTrigger.on('click', function(event){
		event.preventDefault();
		$(this).next('.cd-ADUAN-content').slideToggle(200).end().parent('li').toggleClass('content-visible');
	});

	//update category sidebar while scrolling
	$(window).on('scroll', function(){
		if ( $(window).width() > MqL ) {
			(!window.requestAnimationFrame) ? updateCategory() : window.requestAnimationFrame(updateCategory); 
		}
	});

	$(window).on('resize', function(){
		if($(window).width() <= MqL) {
			ADUANsCategoriesContainer.removeClass('is-fixed').css({
				'-moz-transform': 'translateY(0)',
			    '-webkit-transform': 'translateY(0)',
				'-ms-transform': 'translateY(0)',
				'-o-transform': 'translateY(0)',
				'transform': 'translateY(0)',
			});
		}	
		if( ADUANsCategoriesContainer.hasClass('is-fixed') ) {
			ADUANsCategoriesContainer.css({
				'left': ADUANsContainer.offset().left,
			});
		}
	});

	function closePanel(e) {
		e.preventDefault();
		ADUANsContainer.removeClass('slide-in').find('li').show();
		closeADUANsContainer.removeClass('move-left');
		$('body').removeClass('cd-overlay');
	}

	function updateCategory(){
		updateCategoryPosition();
		updateSelectedCategory();
	}

	function updateCategoryPosition() {
		var top = $('.cd-ADUAN').offset().top,
			height = jQuery('.cd-ADUAN').height() - jQuery('.cd-ADUAN-categories').height(),
			margin = 20;
		if( top - margin <= $(window).scrollTop() && top - margin + height > $(window).scrollTop() ) {
			var leftValue = ADUANsCategoriesContainer.offset().left,
				widthValue = ADUANsCategoriesContainer.width();
			ADUANsCategoriesContainer.addClass('is-fixed').css({
				'left': leftValue,
				'top': margin,
				'-moz-transform': 'translateZ(0)',
			    '-webkit-transform': 'translateZ(0)',
				'-ms-transform': 'translateZ(0)',
				'-o-transform': 'translateZ(0)',
				'transform': 'translateZ(0)',
			});
		} else if( top - margin + height <= $(window).scrollTop()) {
			var delta = top - margin + height - $(window).scrollTop();
			ADUANsCategoriesContainer.css({
				'-moz-transform': 'translateZ(0) translateY('+delta+'px)',
			    '-webkit-transform': 'translateZ(0) translateY('+delta+'px)',
				'-ms-transform': 'translateZ(0) translateY('+delta+'px)',
				'-o-transform': 'translateZ(0) translateY('+delta+'px)',
				'transform': 'translateZ(0) translateY('+delta+'px)',
			});
		} else { 
			ADUANsCategoriesContainer.removeClass('is-fixed').css({
				'left': 0,
				'top': 0,
			});
		}
	}

	function updateSelectedCategory() {
		ADUANsSections.each(function(){
			var actual = $(this),
				margin = parseInt($('.cd-ADUAN-title').eq(1).css('marginTop').replace('px', '')),
				activeCategory = $('.cd-ADUAN-categories a[href="#'+actual.attr('id')+'"]'),
				topSection = (activeCategory.parent('li').is(':first-child')) ? 0 : Math.round(actual.offset().top);
			
			if ( ( topSection - 20 <= $(window).scrollTop() ) && ( Math.round(actual.offset().top) + actual.height() + margin - 20 > $(window).scrollTop() ) ) {
				activeCategory.addClass('selected');
			}else {
				activeCategory.removeClass('selected');
			}
		});
	}
});