<?php get_header(); ?>
<section class="sec_ttl">
	<div class="wrap w1200">
		<h1 class="ttl"><span>進路・進学コラム</span></h1>
	</div>
</section>
<!-- /.sec_ttl -->
<section class="breadcrumb">
	<div class="wrap w1200">
		<ul class="list">
			<li><a href="<?php echo esc_url(home_url('/')); ?>" class="fade">TOP</a></li>
			<li>進路・進学コラム</li>
		</ul>
	</div>
</section>
<!-- /.breadcrumb -->
<section class="sec_visitor section">
	<div class="is_load_anime fadein">
		<div class="wrap w1200">
			<p class="txt">
				高校卒業後の進学・進路の選択肢は無数にあります。自分には何が向いているのか。どんな職業があるのか。学費の他にも進学するのにどれだけのお金が必要になるのか。<br class="sp">こちらでは進学・進路のヒントになるようなコラム記事を紹介しています。</p>
	<?php if(have_posts()): ?>
			<ul class="list grid4">
		<?php while(have_posts()): the_post(); ?>
				<li><a href="<?php the_permalink(); ?>" class="fade">
					<div class="img cut_thumb">
					<?php if(has_post_thumbnail()): ?>
						<?php the_post_thumbnail("visitor_list", array("alt" => "")); ?>
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/visitor/img.png" alt="" class="size">
					<?php else: ?>
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/visitor/noimage.png" alt="">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/visitor/img.png" alt="" class="size">
					<?php endif; ?>
					</div>
					<?php
						$num = 19;
						$numc = $num*2;
						$gettit = strip_tags(get_the_title());
						if($numc <= strlen(mb_convert_encoding($gettit, "SJIS", "UTF-8"))) {
							$title = mb_strimwidth($gettit, 0, $numc, '','UTF-8');
							if($numc < strlen(mb_convert_encoding($gettit, "SJIS", "UTF-8"))) $title .= "…";
						}else{
							$title = $gettit;
						}
					?>
					<p class="txt"><?php echo esc_html($title); ?></p>
				</a></li>
		<?php endwhile; ?>
			</ul>
		<?php
			if(function_exists("responsive_pagination")) {
				responsive_pagination();
			}
		?>
	<?php endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
