<?php
	// CSS・スクリプトの読み込み
	function add_files() {
		global $post;

		wp_enqueue_style('c-font01', 'https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap', array(), '1.0', 'all');
		wp_enqueue_style('c-font02', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap', array('c-font01'), '1.0', 'all');
		wp_enqueue_style('c-common', get_template_directory_uri().'/css/common.css', array('c-font02'), '1.0', 'all');

		if(is_page()) {
			if(have_rows("css")) {
				$cnt = 0;
				$before_css = "common";
				while(have_rows("css")) {
					the_row();
					wp_enqueue_style('c-page'.$cnt, get_template_directory_uri().'/css/'.esc_attr(get_sub_field("file")), array('c-'.$before_css), '1.0', 'all');
					$before_css = "page".$cnt;
					$cnt++;
				}
			}
			else {
				wp_enqueue_style('c-page', get_template_directory_uri().'/css/'.get_toplevel_page_name().'.css', array('c-common'), '1.0', 'all');
			}
		}
		elseif(is_post_type_archive(array("talk", "campusreport")) || is_singular(array("talk", "campusreport"))) {
			wp_enqueue_style('c-page', get_template_directory_uri().'/css/life.css', array('c-common'), '1.0', 'all');
		}
		elseif(is_post_type_archive() || is_single()) {
			$post_type = get_query_var('post_type');
			if(is_singular("visitor")) {
				wp_enqueue_style('c-news', get_template_directory_uri().'/css/news.css', array('c-common'), '1.0', 'all');
				wp_enqueue_style('c-page', get_template_directory_uri().'/css/'.$post_type.'.css', array('c-news'), '1.0', 'all');
			}
			else {
				wp_enqueue_style('c-page', get_template_directory_uri().'/css/'.$post_type.'.css', array('c-common'), '1.0', 'all');
			}
		}
		elseif(is_tax("cat_news")) {
			wp_enqueue_style('c-page', get_template_directory_uri().'/css/news.css', array('c-common'), '1.0', 'all');
		}

		// WordPress本体のjquery.jsを読み込まない
		if(!is_admin()) {
//			wp_deregister_script('jquery');
		}

		wp_enqueue_script('s-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '1.0', true);
		wp_enqueue_script('s-ofi', get_template_directory_uri().'/js/ofi.min.js', array('s-jquery'), '1.0', true);
		wp_enqueue_script('s-main', get_template_directory_uri().'/js/main.js', array('s-ofi'), '1.0', true);

		if(is_page("contact")) {
			wp_enqueue_script('s-autoKana', get_template_directory_uri().'/js/jquery.autoKana.js', array('s-main'), '1.0', true);
			wp_enqueue_script('s-contact', get_template_directory_uri().'/js/contact.js', array('s-autoKana'), '1.0', true);
		}
	}
	add_action('wp_enqueue_scripts', 'add_files');
