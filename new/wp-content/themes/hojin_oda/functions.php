<?php
	require_once("functions/script.php");
	require_once("functions/admin.php");

	// エラーを非表示
	error_reporting(0);

	// <head>内不要項目削除
	remove_action('wp_head', 'wp_generator');							// wp_generatorの削除
	remove_action('wp_head', 'feed_links_extra');						// rsd_linkの削除
	remove_action('wp_head', 'feed_links');								// rsd_linkの削除
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('wp_head', 'index_rel_link');							// rsd_linkの削除
	remove_action('wp_head', 'parent_post_rel_link');					// rsd_linkの削除
	remove_action('wp_head', 'start_post_rel_link');					// rsd_linkの削除
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');		// rsd_linkの削除
	remove_action('wp_head', 'wp_shortlink_wp_head');					// shortlink
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	remove_action('wp_print_styles', 'print_emoji_styles');

	//絵文字の DNS プリフェッチの削除
	add_filter( 'emoji_svg_url', '__return_false' );

	global $youbi_ja;
	global $youbi_en;
	$youbi_ja = array("日", "月", "火", "水", "木", "金", "土");
	$youbi_en = array("SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT");

	// post thumbnails
	add_theme_support('post-thumbnails');
	add_image_size('visitor_list', 280, 168, true);
	add_image_size('news_list', 114, 113, true);

	add_theme_support('title-tag');

	// タイトルをカスタマイズ
	function customize_title($title) {
		global $post;

		if(is_front_page()) {
			return "専門学校｜学校法人 織田学園｜東京・中野";
		}
		elseif(is_post_type_archive("news") || is_tax("cat_news")) {
			return 'ニュース一覧 | '.get_bloginfo();
		}
		elseif(is_singular("news")) {
			return get_the_title().' | '.get_bloginfo().' | '.get_the_terms(get_the_ID(), "cat_news")[0]->name;
		}
		elseif(is_single()) {
			return get_the_title().' | '.get_bloginfo().' | '.get_post_type_object(get_post_type())->label;
		}
		elseif(is_page()) {
			if($post->post_parent) {
				$parent = get_post($parent_id);
				return get_the_title().' | '.get_bloginfo().' | '.get_the_title($parent->post_parent);
			}
			else {
				return get_the_title().' | '.get_bloginfo();
			}
		}
		return $title; 
	}
	add_filter('aioseop_title', 'customize_title');


	function customize_description($description) {
		if(is_post_type_archive("news") || is_tax("cat_news") || is_singular("news")) {
			$description = '織田学園の新着情報・ニュースリリース';
		}
		elseif(is_post_type_archive("visitor") || is_singular("visitor")) {
			$description = '織田学園は東京都中野区にある専門学校です。ファッション、きもの、栄養、調理、製菓のプロを目指そう。調理師国家資格、栄養士国家資格を取得可能な専門学校です。';
		}
		return $description;
	}
	add_filter('aioseop_description', 'customize_description');

	function customize_keywords($keywords) {
		if(is_post_type_archive("news") || is_tax("cat_news") || is_singular("news")) {
			$keywords = '織田学園 新着情報';
		}
		elseif(is_post_type_archive("visitor") || is_singular("visitor")) {
			$keywords = '専門学校, ファッション, きもの, 栄養, 調理師, 製菓';
		}
		return $keywords;
	}
	add_filter('aioseop_keywords', 'customize_keywords');


	// 抜粋をカスタム
	function get_the_custom_excerpt($content, $length=40) {
		$length = ($length ? $length : 40);									// デフォルトの長さを指定する
		$content = preg_replace('/<!--more-->.+/is',"",$content);			//moreタグ以降削除
		$content = strip_shortcodes($content);								// ショートコード削除
		$content = strip_tags($content);									// タグの除去
		$content = str_replace("&nbsp;", "", $content);						// 特殊文字の削除
		$content = str_replace(array("\r\n", "\r", "\n"), "", $content);	// 特殊文字の削除
		$content = mb_substr($content, 0, $length);							// 文字列を指定した長さで切り取る
		$content = rtrim($content, "<br>");
		$content = str_replace("<br> (さらに&hellip;)", "", $content);			// 「(さらに…)」の削除
		$content = str_replace("(さらに&hellip;)", "", $content);			// 「(さらに…)」の削除
		return $content."[…]";
	}


	// 投稿取得条件を変更
	function change_posts_per_page($query) {
		/* 管理画面,メインクエリに干渉しないために必須 */
		if(is_admin() || !$query->is_main_query()) {
			return;
		}

		// ニュースリリース一覧は1ページ10件
		if($query->is_post_type_archive("news") || $query->is_tax("cat_news")) {
			$query->set('posts_per_page', 10);
			return;
		}
		// コラム一覧は1ページ16件
		elseif($query->is_post_type_archive("visitor")) {
			$query->set('posts_per_page', 16);
			return;
		}
	}
	add_action('pre_get_posts', 'change_posts_per_page');


	function replaceImagePath($arg) {
		$content = str_replace('"img/', '"' . get_bloginfo('template_directory') . '/img/', $arg);
		$content = str_replace(', img/', ', ' . get_bloginfo('template_directory') . '/img/', $content);
		$content = str_replace("('img/", "('". get_bloginfo('template_directory') . '/img/', $content);
//		$content = str_replace('<p><img', '<p class="img"><img', $content);
		return $content;
	}
	add_action('the_content', 'replaceImagePath');


	function replacePdfPath($arg) {
		$content = str_replace('"pdf/', '"' . get_bloginfo('template_directory') . '/pdf/', $arg);
		return $content;
	}
	add_action('the_content', 'replacePdfPath');


	function replaceHttpPath($arg) {
		$content = str_replace('[http]', esc_url(home_url('/')), $arg);
		return $content;
	}
	add_action('the_content', 'replaceHttpPath');


	function replaceHttpsPath($arg) {
		$content = str_replace('[https]', esc_url(home_url('/', 'https')), $arg);
		return $content;
	}
	add_action('the_content', 'replaceHttpsPath');


	/* ショートコード */
	// TOPページ
	function shortcode_hurl() {
		return home_url('/');
	}
	add_shortcode('hurl', 'shortcode_hurl');

	// トップページニュースリリース
	function shortcode_top_news() {
		global $post;
		$news_link = esc_url(get_post_type_archive_link("news"));
		$tmp_dir = esc_url(get_template_directory_uri());
		$args = array(
			'posts_per_page' => 4,
			'post_type' => 'news'
		);
		$posts = get_posts($args);
		if($posts) {
			$html .= <<< EOT
<section class="sec_news section">
	<div class="is_anime fadein">
		<div class="wrap">
			<h2 class="ttl_sec"><span class="en roboto">News</span>ニュースリリース</h2>
			<ul class="list grid2 stretch">
EOT;
			foreach($posts as $post) {
				setup_postdata($post);
				$url = esc_url(get_the_permalink());
				$date = get_the_time("Y.m.d");
				if(has_post_thumbnail(get_the_ID())) {
					$image = get_the_post_thumbnail(get_the_ID(), "news_list", array("alt" => "", "class" => "cut_img"));
				}
				else {
					$image = '<img src="'.$tmp_dir.'/img/index/noimage.jpg" alt="" class="cut_img">';
				}
				if(is_mobile()) {
					$num = 33;
				}
				else {
					$num = 40;
				}
				$numc = $num*2;
				$gettit = strip_tags(get_the_title());
				if($numc <= strlen(mb_convert_encoding($gettit, "SJIS", "UTF-8"))) {
					$title = mb_strimwidth($gettit, 0, $numc, '','UTF-8');
					if($numc < strlen(mb_convert_encoding($gettit, "SJIS", "UTF-8"))) $title .= "…";
				}else{
					$title = $gettit;
				}
				$title = esc_html($title);
				$cat_name = esc_html(get_the_terms(get_the_ID(), "cat_news")[0]->name);
				$cat_slug = esc_html(get_the_terms(get_the_ID(), "cat_news")[0]->slug);
				$html .= <<<EOT
				<li class="{$cat_slug}">
					<a href="{$url}">
						<div class="img">{$image}</div>
						<div class="box_txt">
							<p class="tag">{$cat_name}</p>
							<p class="date">{$date}</p>
							<p class="txt">{$title}</p>
						</div>
					</a>
				</li>
EOT;
			}
			$html .= <<<EOT
			</ul>
			<p class="btn tac"><a href="{$news_link}" class="btn_yellow roboto">read more</a></p>
		</div>
	</div>
</section>
<!-- /.sec_news -->
EOT;
		}
		wp_reset_postdata();
		return $html;
	}
	add_shortcode('top_news', 'shortcode_top_news');


	// ページネーション
	function responsive_pagination($pages='', $range=1) {
		global $paged;
		if(empty($paged)) $paged = 1;

		//ページ情報の取得
		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}

		if($pages <= 1) return;

		echo '<ul class="pagination">';

		if($paged != 1) {
			echo '<li class="prev"><a href="'.get_pagenum_link($paged - 1).'" class="fade">前へ</a></li>';
			echo '<li><a href="'.get_pagenum_link(1).'" class="fade">1</a></li>';

			if($paged-($range+1) > 1 && $pages > $range*2+1) {
				echo '<li><p>･･･</p></li>';
			}
		}
		else {
			echo '<li><a href="'.get_pagenum_link(1).'" class="this fade">1</a></li>';
//			echo '<div class="preview"></div>';
		}

		// 番号つきページ送りボタン
		if($pages > 1) {
			$display_arr = array();
			if($paged - $range - 1 < 0) {
				$under_cnt = abs($paged - $range - 1);
			}
			if($paged + $range - $pages > 0) {
				$over_cnt = $paged + $range - $pages;
			}
			for($i=2; $i<=$pages; $i++) {
				if($paged == 1 && $i <= $paged + $range * 2) {
					$display_arr[] = $i;
				}
				elseif($paged == $pages && $i >= $paged - $range * 2) {
					$display_arr[] = $i;
				}
				elseif($i >= $paged - $range - $over_cnt && $i <= $paged + $range + $under_cnt) {
					$display_arr[] = $i;
				}
			}

			foreach($display_arr as $val) {
				echo ($paged == $val) ? '<li class="current"><a href="'.get_pagenum_link($val).'" class="fade">'.$val.'</a></li>':'<li><a href="'.get_pagenum_link($val).'" class="fade">'.$val.'</a></li>';
			}
		}

		if($paged != $pages) {
			if($pages > $range*2+1 && $paged < $pages-$range) {
				if($paged < $pages-$range-1) {
					echo '<li><p>･･･</p></li>';
				}
				echo '<li><a href="'.get_pagenum_link($pages).'" class="fade">'.$pages.'</a></li>';
			}

			echo '<li class="next"><a href="'.get_pagenum_link($paged + 1).'" class="fade">次へ</a></li>';
		}
		else {
//			echo '<div class="next"></div>';
		}

		echo '</ul>';
	}

	// previous_post_link()とnext_post_link()を変更
	function add_prev_post_link_class($output) {
		$output = str_replace('rel="prev">', 'rel="prev"><span>', $output);
		$output = str_replace('</a>', '</span></a>', $output);
		return $output;
	}
	add_filter('previous_post_link', 'add_prev_post_link_class');
	function add_next_post_link_class($output) {
		$output = str_replace('rel="next">', 'rel="next"><span>', $output);
		$output = str_replace('</a>', '</span></a>', $output);
		return $output;
	}
	add_filter('next_post_link', 'add_next_post_link_class');


	// スマホ判別
	function is_mobile() {
		$useragents = array(
			'iPhone', // iPhone
			'iPod', // iPod touch
			'^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
			'dream', // Pre 1.5 Android
			'CUPCAKE', // 1.5+ Android
			'blackberry9500', // Storm
			'blackberry9530', // Storm
			'blackberry9520', // Storm v2
			'blackberry9550', // Storm v2
			'blackberry9800', // Torch
			'webOS', // Palm Pre Experimental
			'incognito', // Other iPhone browser
			'webmate' // Other iPhone browser
		);
		$pattern = '/'.implode('|', $useragents).'/i';
		return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
	}


	// 一番上の親ページ名を取得
	function get_toplevel_page_name() {
		if(!is_page()) {
			return '';
		}

		global $post;
		$p = $post;
		while($p->post_parent != 0) {
			$p = get_post($p->post_parent);
		}
		return $p->post_name;
	}
