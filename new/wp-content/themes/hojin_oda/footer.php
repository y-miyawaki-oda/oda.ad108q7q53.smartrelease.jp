		<section class="sec_contact section bg_yellow2">
			<div class="wrap">
				<h2 class="ttl_sec"><span class="en roboto">Contact us</span>お問い合わせ</h2>
				<div class="box">
					<h3 class="ttl_28">学校法人織田学園<br class="sp"> 総合受付</h3>
					<p class="btn_tel btn tac">
						<a href="tel:0332282111"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/tel_icon_yellow.png" alt="">03-3228-2111</a>
					</p>
					<p class="time">受付時間9:00 - 17:00</p>
				</div>
				<div class="box contact">
					<p class="btn tac"><a href="<?php echo esc_url(home_url('/')); ?>contact/" class="btn_yellow">お問い合わせフォーム</a></p>
				</div>
			</div>
		</section>
		<!-- /.sec_contact -->
	</main>

	<footer<?php if(is_page(array("confirm", "thanks"))) echo ' class="pb0"'; ?>>
		<div class="topbtn">
			<div class="wrap">
				<div class="btn tar"><a href="#" class="fade"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/topbtn.png" alt="TOP"></a></div>
			</div>
		</div>
		<div class="footer_contact">
			<div class="wrap">
				<div class="grid2">
					<div class="box box_info">
						<h3 class="ttl_30 white medium">学校法人 織田学園</h3>
						<p class="addr">〒164-0001 東京都中野区中野5-32-8</p>
						<div class="box_btn">
							<p class="btn btn_tel"><a href="tel:0332282111"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/tel_icon_black.png" alt="">03-3228-2111</a></p>
							<p class="btn"><a href="<?php echo esc_url(home_url('/')); ?>access/"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/map_icon_black.png" alt="">アクセスマップ</a></p>
						</div>
					</div>
					<div class="box box_sns">
						<h3 class="ttl_40 white roboto">SNS</h3>
						<div class="box_btn">
							<p class="btn"><a href="https://twitter.com/odagakuen" target="_blank">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/footer_twitter_black.png" alt="" class="off">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/footer_twitter_blue.png" alt="" class="on">
							</a></p>
							<p class="btn"><a href="https://www.facebook.com/odagakuen" target="_blank">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/footer_fb_black.png" alt="" class="off">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/footer_fb_blue.png" alt="" class="on">
							</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_navi">
			<div class="wrap">
				<ul class="link">
					<li><a href="<?php echo esc_url(home_url('/')); ?>about/reports/">情報公開</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>">学校法人織田学園</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>sitemap/">サイトマップ</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>privacy/">プライバシー・ポリシー</a></li>
				</ul>
				<p class="copyright">&copy; Copyright 2020. Oda.ac. All rights reserved.</p>
			</div>
		</div>
	</footer>
<?php if(is_page("contact")): ?>
	<div class="fixedbnr fixed_countbnr">
		<ul class="req">
			<li><span class="v">残り必須項目</span><span class="num"></span></li>
		</ul>
	</div>
<?php endif; ?>
</div>

<?php wp_footer(); ?>
<?php if(is_page("contact")): ?>
<script>
	/*-------------------------------------------
	 fixbnr
	 -------------------------------------------*/
	var countbnr=$('.fixed_countbnr');
	countbnr.hide();
	$(window).scroll(function(){
		if($(this).scrollTop() > 200){
			countbnr.fadeIn(800);
		}else{
			countbnr.fadeOut(800);
		}
	});
</script>
<?php endif; ?>

</body>
</html>
