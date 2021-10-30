/*-------------------------------------------
 transition対策
 -------------------------------------------*/
$(window).on('load', function(){
	$('body').removeClass('preload');
	$('.is_load_anime').each(function(){
		var trigger = $(this);
		trigger.addClass('anime_active');
	});
});


$(function(){

	var menuWidth = 1259;

	function widthCheck() {
		var winWidth = window.innerWidth;
		var state = false;
		var scrollpos;
		if(winWidth <= menuWidth) {
			/*-------------------------------------------
			 sp menu
			 -------------------------------------------*/
			widthFlag = 'menu-sp';
			var state = false;
			var scrollpos;
			var naviWidth = $('.hamnavi').outerWidth();
			$('.hamnavi').css('right',-naviWidth);
			$('.menu_trigger').click(function() {
				if(state == false) {
					scrollpos = $(window).scrollTop();
					$('.container').addClass('fixed').css({'top': -scrollpos});
					$('header,.hamnavi,.overlay').addClass('menu_open');
					$('.overlay').fadeIn(400);
					$('.hamnavi').animate({'right' : 0 }, 300);
					$('.hamnavi').css('display','block');
					window.scrollTo( 0 , 0 );
					state = true;
				} else {
					setTimeout(function() {
						$('.container').removeClass('fixed').css({'top': 0});
						window.scrollTo( 0 , scrollpos );
					}, 300);
					$('header,.hamnavi,.overlay').removeClass('menu_open');
					$('.overlay').fadeOut(400);
					$('.hamnavi').animate({'right' : -naviWidth }, 300 ,function(){
						$('.hamnavi').css('display','none');
					});
					state = false;
				}
			});
			$('.overlay').click(function(){
				if(state == true) {
					$('.menu_trigger').trigger("click");
				}
			});
		}
	}

	widthCheck();

	$('.hamnavi .acdbtn').on('click', function() {
		$(this).siblings('.acdmenu').slideToggle();
		$(this).toggleClass('open');
	});
	$('.hoverbtn').hover(function(){
		$(this).children('.hovermenu').stop().fadeIn('');
	},
	function(){
		$(this).children('.hovermenu').stop().fadeOut('');
	});

    var lastWW = window.innerWidth;
    $(window).on('resize', function() {
        var currentWW = window.innerWidth;
        //1259pxを跨ぐ移動
        if (lastWW <= menuWidth && menuWidth < currentWW) {
           window.location = window.location;
        } else if (currentWW <= menuWidth && menuWidth < lastWW) {
           window.location = window.location;
        }
        lastWW = currentWW;
    });


	/*-------------------------------------------
	 responsive image
	 -------------------------------------------*/
	var $setElem = $('.switch'),
	pcName = '_pc',
	spName = '_sp',
	replaceWidth = 767;

	$setElem.each(function(){
	    var $this = $(this);
	    function imgSize(){
	        if(window.innerWidth > replaceWidth) {
	            $this.attr('src',$this.attr('src').replace(spName,pcName)).css({visibility:'visible'});
	        } else {
	            $this.attr('src',$this.attr('src').replace(pcName,spName)).css({visibility:'visible'});
	        }
	    }
	    $(window).resize(function(){imgSize();});
	    imgSize();
    });

	/*-------------------------------------------
	scroll
	-------------------------------------------*/
	$('a[href^="#"]').click(function() {
		var hH = $('.header01').outerHeight();
		var speed = 300;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top - hH;
		$('body,html').animate({scrollTop:position}, speed, 'swing');
		return false;
	});

	/*-------------------------------------------
	 ofject
	 -------------------------------------------*/
	if($('.cut_img,.cut_thumb img').length){
		objectFitImages('img.cut_img');
	}
	if($('.cut_thumb').length){
		objectFitImages('.cut_thumb img:first-child');
	}

	/*-------------------------------------------
	 fb
	 -------------------------------------------*/
	if($('.sec_sns').length){
		function pagePluginCode(w) {
			var h = 565;
			return '<div class="fb-page" data-href="https://www.facebook.com/odagakuen" data-tabs="timeline" data-width="' + w + '" data-height="' + h + '" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/odagakuen" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/odagakuen">織田学園</a></blockquote></div>';
		}
		var facebookWrap = $('.facebook-wrapper');
		var fbBeforeWidth = '';
		var fbWidth = facebookWrap.width();
		var fbTimer = false;
		$(window).on('load resize', function() {
			if (fbTimer !== false) {
				clearTimeout(fbTimer);
			}
			fbTimer = setTimeout(function() {
				fbWidth = Math.floor(facebookWrap.width());
				if(fbWidth != fbBeforeWidth) {
					facebookWrap.html(pagePluginCode(fbWidth));
					window.FB.XFBML.parse();
					fbBeforeWidth = fbWidth;
				}
			}, 200);
		});
	}

	/*-------------------------------------------
	 tab
	 -------------------------------------------*/
	if($('.sec_sns').length){
		$('.sec_sns .ttl .box').click(function(){
			$(this).siblings('.current').removeClass('current');
			$(this).addClass('current');
			const index = $(this).index();
			$(this).parents('.ttl').next('.item').children('.box').removeClass('current');
			$(this).parents('.ttl').next('.item').children('.box').eq(index).addClass('current');
			//fb
			fbWidth = Math.floor(facebookWrap.width());
			if(fbWidth != fbBeforeWidth) {
				facebookWrap.html(pagePluginCode(fbWidth));
				window.FB.XFBML.parse();
				fbBeforeWidth = fbWidth;
			}
		});
	}

	/*-------------------------------------------
	 acd
	 -------------------------------------------*/
	$('.sec_recruit .btn').on('click', function() {
		$(this).siblings('.children').slideToggle();
		$(this).toggleClass('open');
	});
	$('.sec_search .select_year .btn').on('click', function() {
		$(this).siblings('.children').slideToggle();
		$(this).toggleClass('open');
	});
	$('.sec_search .select_year li').click(function(){
		location.href = $(this).data("value");
//		var newText = $(this).html();
//		$('.sec_search .select_year .btn .txt').text(newText);
//		$('.sec_search .select_year .btn').trigger("click");
	});

	/*-------------------------------------------
	アニメーション
	-------------------------------------------*/
	$(window).on('scroll load', function() {
		$('.is_anime').each(function(){
			var trigger = $(this),
				top = trigger.offset().top,
				position = top - $(window).height(),
				position_bottom = top + trigger.height();
			if($(window).scrollTop() > position && $(window).scrollTop() < position_bottom){
				trigger.addClass('anime_active');
			//}else{
			//	trigger.removeClass('anime_active');
			}
		});
	});


	/*-------------------------------------------
	カテゴリ選択
	-------------------------------------------*/
	$('.select .list li input[type="radio"]').on('click', function() {
		location.href = $(this).val();
	});
});


/*
* css swicher
*/
function css_browser_selector(u){
	var ua=u.toLowerCase(),
	is=function(t){return ua.indexOf(t)>-1},
	e='edge',g='gecko',w='webkit',s='safari',o='opera',m='mobile',
	h=document.documentElement,
	b=[
		( !(/opera|webtv/i.test(ua)) && /msie\s(\d)/.test(ua))? ('ie ie'+RegExp.$1) :
			!(/opera|webtv/i.test(ua)) && is('trident') && /rv:(\d+)/.test(ua)? ('ie ie'+RegExp.$1) :
			is('edge/')? e:
			is('firefox/2')?g+' ff2':
			is('firefox/3.5')? g+' ff3 ff3_5' :
			is('firefox/3.6')?g+' ff3 ff3_6':is('firefox/3')? g+' ff3' :
			is('gecko/')?g:
			is('opera')? o+(/version\/(\d+)/.test(ua)? ' '+o+RegExp.$1 :
			(/opera(\s|\/)(\d+)/.test(ua)?' '+o+RegExp.$2:'')) :
			is('konqueror')? 'konqueror' :
			is('blackberry')?m+' blackberry' :
			is('android')?m+' android' :
			is('chrome')?w+' chrome' :
			is('iron')?w+' iron' :
			is('applewebkit/')? w+' '+s+(/version\/(\d+)/.test(ua)? ' '+s+RegExp.$1 : '') :
			is('mozilla/')? g:
			'',
			is('j2me')?m+' j2me':
			is('iphone')?m+' iphone':
			is('ipod')?m+' ipod':
			is('ipad')?m+' ipad':
			is('mac')?'mac':
			is('darwin')?'mac':
			is('webtv')?'webtv':
			is('win')? 'win'+(is('windows nt 6.0')?' vista':''):
			is('freebsd')?'freebsd':
			(is('x11')||is('linux'))?'linux':
			'',
			'js'];
	c = b.join(' ');
	h.className += ' '+c;
	return c;
};
css_browser_selector(navigator.userAgent);