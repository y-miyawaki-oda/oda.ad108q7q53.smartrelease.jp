<?php get_header(); ?>
<?php
	$post_type = 'news';
	$taxonomy  = 'cat_news';

	$current_label = is_tax($taxonomy)? get_queried_object(): null;
	$current_year  = is_year()? get_query_var('raw_year'): null;
?>
<section class="sec_ttl">
	<div class="wrap w1200">
		<h1 class="ttl"><span>ニュースリリース</span></h1>
	</div>
</section>
<!-- /.sec_ttl -->
<section class="breadcrumb">
	<div class="wrap w1200">
		<ul class="list">
			<li><a href="<?php echo esc_url(home_url('/')); ?>" class="fade">TOP</a></li>
		<?php if(is_tax()): ?>
			<li><a href="<?php echo esc_url(get_post_type_archive_link("news")); ?>" class="fade">ニュースリリース</a></li>
			<li><?php single_term_title(); ?></li>
		<?php else: ?>
			<li>ニュースリリース</li>
		<?php endif; ?>
		</ul>
	</div>
</section>
<!-- /.breadcrumb -->
<section class="sec_search section">
	<div class="is_load_anime fadein">
		<div class="wrap w1200">
			<h2 class="ttl"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/search_icon_gray.png" alt="">ニュースを探す</h2>
			<div class="select">
				<ul class="list">
					<li>
						<label><input type="radio" name="cat_news" value="<?php echo esc_url(oda_get_archive_link($current_year, get_term_by('slug', 'info', 'cat_news'))); ?>"<?php if(is_tax("cat_news", "info")) echo ' checked'; ?>><span class="txt_check"><span class="icon"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/search_icon_white.png" alt="" class="off"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/search_icon_black.png" alt="" class="on"></span>お知らせ</span></label>
					</li>
					<li>
						<label><input type="radio" name="cat_news" value="<?php echo esc_url(oda_get_archive_link($current_year, get_term_by('slug', 'topics', 'cat_news'))); ?>"<?php if(is_tax("cat_news", "topics")) echo ' checked'; ?>><span class="txt_check"><span class="icon"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/search_icon_white.png" alt="" class="off"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/search_icon_black.png" alt="" class="on"></span>トピックス</span></label>
					</li>
					<li>
						<label><input type="radio" name="cat_news" value="<?php echo esc_url(oda_get_archive_link($current_year, get_term_by('slug', 'urgent_info', 'cat_news'))); ?>"<?php if(is_tax("cat_news", "urgent_info")) echo ' checked'; ?>><span class="txt_check"><span class="icon"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/search_icon_white.png" alt="" class="off"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/search_icon_black.png" alt="" class="on"></span>緊急の<br class="sp">お知らせ</span></label>
					</li>
				</ul>
				<div class="select_year">
					<p class="btn"><span class="txt"><?php if($current_year) echo esc_html($current_year."年度"); else echo '年度を選択して絞り込み'; ?></span><span class="icon"></span></p>
					<ul class="children">
						<li data-value="<?php echo esc_html(oda_get_archive_link(null, $current_label)); ?>">年度を選択して絞り込み</li>
					<?php $yearly = oda_news_get_yearly_archives('DESC'); ?>
					<?php foreach($yearly as $year=>$url): ?>
						<li data-value="<?php echo esc_html(oda_get_archive_link($year, $current_label)); ?>"><?php echo esc_html($year); ?>年度</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.sec_search -->
<section class="sec_news section bg_gray">
	<div class="is_load_anime fadein">
	<?php if(have_posts()): ?>
		<div class="wrap w1200">
			<ul class="list grid2 stretch">
		<?php while(have_posts()): the_post(); ?>
			<?php $cat_news = get_the_terms(get_the_ID(), "cat_news")[0]; ?>
				<li class="<?php echo esc_attr($cat_news->slug); ?>"><a href="<?php the_permalink(); ?>" class="fade">
					<div class="img">
					<?php if(has_post_thumbnail()): ?>
						<?php the_post_thumbnail("news_list", array("alt" => "", "class" => "cut_img")); ?>
					<?php else: ?>
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/index/noimage.jpg" alt="" class="cut_img">
					<?php endif; ?>
					</div>
					<div class="box_txt">
						<p class="tag"><?php echo esc_html($cat_news->name); ?></p>
						<p class="date"><?php the_time("Y.m.d"); ?></p>
					<?php
						if(is_mobile()) {
							$num = 33;
						}
						else {
							$num = 36;
						}
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
					</div>
				</a></li>
		<?php endwhile; ?>
			</ul>
		<?php
			if(function_exists("responsive_pagination")) {
				responsive_pagination();
			}
		?>
		</div>
	<?php endif; ?>
	</div>
</section>
<!-- /.sec_news -->
<?php get_footer(); ?>
