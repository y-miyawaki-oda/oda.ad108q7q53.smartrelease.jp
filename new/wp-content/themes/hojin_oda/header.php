<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<meta name="format-detection" content="telephone=no">
	<meta property="og:locale" content="ja_JP">
<?php if(is_post_type_archive() || is_tax()): ?>
<?php
	if(is_post_type_archive("news")) {
		$title = "ニュース一覧｜学校法人 織田学園";
		$description = "織田学園の新着情報・ニュースリリース";
	}
	elseif(is_tax("cat_news")) {
		$title = "ニュース一覧｜学校法人 織田学園";
		$description = "織田学園の新着情報・ニュースリリース";
	}
	elseif(is_post_type_archive("visitor")) {
		$title = "進路・進学コラム｜学校法人 織田学園";
		$description = "織田学園は東京都中野区にある専門学校です。ファッション、きもの、栄養、調理、製菓のプロを目指そう。調理師国家資格、栄養士国家資格を取得可能な専門学校です。";
	}
?>
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo esc_attr($title); ?>" />
	<meta property="og:description" content="<?php echo esc_attr($description); ?>" />
	<meta property="og:url" content="<?php echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
	<meta property="og:site_name" content="学校法人織田学園" />
	<meta property="og:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/no_image.png" />
	<meta property="og:image:secure_url" content="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/no_image.png" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@odagakuen">
	<meta name="twitter:title" content="<?php echo esc_attr($title); ?>" />
	<meta name="twitter:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/no_image.png" />
<?php endif; ?>
	<?php wp_head(); ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-W4XVTJ4');</script>
	<!-- End Google Tag Manager -->
</head>

<body class="preload">

<div class="overlay"></div>

<header>
	<div class="header01">
		<div class="wrap">
			<div class="logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="fade"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/logo_pc.png" alt="学園法人 織田学園" class="switch"></a></div>
			<div class="pcnavi">
				<nav class="gnavi">
					<ul class="main">
						<li class="hoverbtn">
							<a href="<?php echo esc_url(home_url('/')); ?>about/">
								<span class="icon">
									<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon01.png" alt="" class="off">
									<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon01_on.png" alt="" class="on">
								</span>
								<span class="txt">学園紹介</span>
							</a>
							<div class="hovermenu">
								<div class="wrap">
									<ul class="children">
										<li><a href="<?php echo esc_url(home_url('/')); ?>about/message/">
											<span class="icon">
												<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon01.png" alt="">
											</span>
											<span class="txt">理事長メッセージ</span>
										</a></li>
										<li><a href="<?php echo esc_url(home_url('/')); ?>about/philosophy/">
											<span class="icon">
												<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon02.png" alt="">
											</span>
											<span class="txt">理念・方針</span>
										</a></li>
										<li><a href="<?php echo esc_url(home_url('/')); ?>about/history/">
											<span class="icon">
												<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon03.png" alt="">
											</span>
											<span class="txt">学園沿革</span>
										</a></li>
										<li><a href="<?php echo esc_url(home_url('/')); ?>about/schools/">
											<span class="icon">
												<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon04.png" alt="">
											</span>
											<span class="txt">設置校</span>
										</a></li>
										<li><a href="<?php echo esc_url(home_url('/')); ?>about/reports/">
											<span class="icon">
												<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon05.png" alt="">
											</span>
											<span class="txt">情報公開</span>
										</a></li>
									</ul>
								</div>
							</div>
						</li>
						<li><a href="<?php echo esc_url(get_post_type_archive_link("visitor")); ?>">
							<span class="icon">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon02.png" alt="" class="off">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon02_on.png" alt="" class="on">
							</span>
							<span class="txt">進路・進学コラム</span>
						</a></li>
						<li><a href="<?php echo esc_url(home_url('/')); ?>company/">
							<span class="icon">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon03.png" alt="" class="off">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon03_on.png" alt="" class="on">
							</span>
							<span class="txt">求人のご登録</span>
						</a></li>
						<li><a href="<?php echo esc_url(home_url('/')); ?>recruit/">
							<span class="icon">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon04.png" alt="" class="off">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon04_on.png" alt="" class="on">
							</span>
							<span class="txt">採用情報</span>
						</a></li>
					</ul>
				</nav>
				<ul class="info">
					<li><a href="<?php echo esc_url(home_url('/')); ?>access/">
						<span class="icon pc_navi">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon05.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon05_on.png" alt="" class="on">
						</span>
						<span class="icon sp_navi">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon05_sp.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon05_sp_on.png" alt="" class="on">
						</span>
						<span class="txt">アクセス</span>
					</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>contact/">
						<span class="icon pc_navi">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon06.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon06_on.png" alt="" class="on">
						</span>
						<span class="icon sp_navi">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon06_sp.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon06_sp_on.png" alt="" class="on">
						</span>
						<span class="txt">Contact</span>
					</a></li>
				</ul>
				<div class="menu_trigger sp_navi"><span></span><span></span></div>
			</div>
		</div>
	</div>
</header>

<nav class="hamnavi gnavi sp_navi">
	<ul class="main">
		<li>
			<span class="acdbtn sp_navi"></span>
			<a href="<?php echo esc_url(home_url('/')); ?>about/">
				<span class="icon">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon01.png" alt="" class="off">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon01_on.png" alt="" class="on">
				</span>
				<span class="txt">学園紹介</span>
			</a>
			<div class="acdmenu sp_navi">
				<ul class="children">
					<li><a href="<?php echo esc_url(home_url('/')); ?>about/message/">
						<span class="icon">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon01.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon01_on.png" alt="" class="on">
						</span>
						<span class="txt">理事長メッセージ</span>
					</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>about/philosophy/">
						<span class="icon">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon02.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon02_on.png" alt="" class="on">
						</span>
						<span class="txt">理念・方針</span>
					</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>about/history/">
						<span class="icon">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon03.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon03_on.png" alt="" class="on">
						</span>
						<span class="txt">学園沿革</span>
					</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>about/schools/">
						<span class="icon">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon04.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon04_on.png" alt="" class="on">
						</span>
						<span class="txt">設置校</span>
					</a></li>
					<li><a href="<?php echo esc_url(home_url('/')); ?>about/reports/">
						<span class="icon">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon05.png" alt="" class="off">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_children_icon05_on.png" alt="" class="on">
						</span>
						<span class="txt">情報公開</span>
					</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo esc_url(get_post_type_archive_link("visitor")); ?>">
			<span class="icon">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon02.png" alt="" class="off">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon02_on.png" alt="" class="on">
			</span>
			<span class="txt">進路・進学コラム</span>
		</a></li>
		<li><a href="<?php echo esc_url(home_url('/')); ?>company/">
			<span class="icon">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon03.png" alt="" class="off">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon03_on.png" alt="" class="on">
			</span>
			<span class="txt">求人のご登録</span>
		</a></li>
		<li><a href="<?php echo esc_url(home_url('/')); ?>recruit/">
			<span class="icon">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon04.png" alt="" class="off">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_icon04_on.png" alt="" class="on">
			</span>
			<span class="txt">採用情報</span>
		</a></li>
	</ul>
	<ul class="school sp_navi">
		<li><a href="https://fashion.oda.ac.jp/" class="fade" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_school01.jpg" alt="織田ファッション専門学校"></a></li>
		<li><a href="https://kimono.oda.ac.jp/" class="fade" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_school02.jpg" alt="織田きもの専門学校"></a></li>
		<li><a href="https://cook.oda.ac.jp/" class="fade" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_school03.jpg" alt="織田調理師専門学校"></a></li>
		<li><a href="https://seika.oda.ac.jp/" class="fade" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_school04.jpg" alt="織田製菓専門学校"></a></li>
		<li><a href="https://eiyo.oda.ac.jp/" class="fade" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_school05.jpg" alt="織田栄養専門学校"></a></li>
		<li><a href="http://www.odakids.com/" class="fade" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_school06.jpg" alt="おだ認定こども園"></a></li>
		<li><a href="#" class="fade" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/navi_school07.jpg" alt="おだ学園保育園"></a></li>
	</ul>
</nav>

<div class="container">
	<main>
