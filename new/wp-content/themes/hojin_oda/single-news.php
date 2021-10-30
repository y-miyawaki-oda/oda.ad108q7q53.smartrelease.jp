<?php get_header(); ?>
<?php if(have_posts()): ?>
	<?php while(have_posts()): the_post(); ?>
<section class="sec_ttl">
	<div class="wrap w1200">
		<p class="ttl"><span>ニュースリリース</span></p>
	</div>
</section>
<!-- /.sec_ttl -->
<section class="breadcrumb">
	<div class="wrap w1200">
		<ul class="list">
			<li><a href="<?php echo esc_url(home_url('/')); ?>" class="fade">TOP</a></li>
			<li><a href="<?php echo esc_url(get_post_type_archive_link("news")); ?>" class="fade">ニュースリリース</a></li>
			<li><?php the_title(); ?></li>
		</ul>
	</div>
</section>
<!-- /.breadcrumb -->
<section class="sec_detail section">
	<div class="is_load_anime fadein">
		<div class="wrap w960">
			<div class="head">
				<div class="info">
					<p class="date"><?php the_time("Y.m.d"); ?></p>
					<?php $cat_news = get_the_terms(get_the_ID(), "cat_news")[0]; ?>
					<p class="tag <?php echo esc_attr($cat_news->slug); ?>"><?php echo esc_html($cat_news->name); ?></p>
				</div>
				<h1 class="ttl"><span><?php the_title(); ?></span></h1>
				<ul class="sns">
					<li><a href="https://twiter.com/share?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="fade"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/detail_icon01.png" alt="Twitter"></a></li>
					<li><a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" rel="nofollow" target="_blank" class="fade"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/news/detail_icon02.png" alt="Facebook"></a></li>
				</ul>
			</div>
			<div class="cnt cf">
				<?php the_content(); ?>
			</div>
			<ul class="pagination pagination2">
				<li class="prev">
				<?php $prev_post = get_previous_post(); ?>
				<?php if(!empty($prev_post)): ?>
					<a href="<?php echo get_permalink($prev_post->ID); ?>" class="fade">前へ</a>
				<?php endif; ?>
				</li>
				<li class="back"><a href="<?php echo esc_url(get_post_type_archive_link("news")); ?>" class="fade">一覧へ</a></li>
				<li class="next">
				<?php $next_post = get_next_post(); ?>
				<?php if(!empty($next_post)): ?>
					<a href="<?php echo get_permalink($next_post->ID); ?>" class="fade">次へ</a>
				<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
</section>
<!-- /.sec_search -->
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
