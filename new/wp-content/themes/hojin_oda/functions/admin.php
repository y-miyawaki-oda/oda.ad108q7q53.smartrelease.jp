<?php
	// 不要なメニューを非表示
	function remove_menus () {
		global $menu;
		unset($menu[5]);	// 投稿
		unset($menu[25]);	// コメント
	}
	add_action('admin_menu', 'remove_menus', 999);


	// 固定ページとMW WP Formでビジュアルモードを使用しない
	function stop_rich_editor($editor) {
		global $typenow;
		global $post;
		if(in_array($typenow, array('page', 'mw-wp-form'))) {
			$editor = false;
		}
		return $editor;
	}
	add_filter('user_can_richedit', 'stop_rich_editor');

/*
	// 投稿ページでテキストモードを使用しない
	add_filter('wp_editor_settings', function($settings) {
		global $typenow;
		if(in_array($typenow, array('news', 'case')) && user_can_richedit()) {
			$settings['quicktags'] = false;
		}

		return $settings;
	});
*/


	// オプションページを追加
/*
	if(function_exists('acf_add_options_page')) {
		$option_page = acf_add_options_page(array(
			'page_title' => 'トップページ設定', // 設定ページで表示される名前
			'menu_title' => 'トップページ設定', // ナビに表示される名前
			'menu_slug' => 'top_setting',
			'capability' => 'edit_posts',
			'redirect' => false
		));
	}
*/


	// カスタム投稿とタクソノミーを追加
	add_action('init', function(){
		// ニュースリリース
		register_post_type('news',
			array(
				'labels' => array(
					'name' => __('ニュースリリース'),
					'singular_name' => __('ニュースリリース')
				),
				'rewrite' => array(
					'slug' => 'news',
					'with_front' => false
				),
				'hierarchical' => false,
				'has_archive' => true,
				'menu_position' => 21,
				'public' => true,
				"supports" => [ "title", "editor", "thumbnail" ],
			)
		);

		// ニュースリリースカテゴリー
		register_taxonomy(
			'cat_news',
			'news',
			array(
				'update_count_callback' => '_update_post_term_count',
				'label' => 'ニュースリリースカテゴリー',
				'labels' => array(
					'singular_name' => 'ニュースリリースカテゴリー',
					'menu_name' => 'カテゴリー',
				),
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => false,
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => 'news',
					'with_front' => false
				),
			)
		);

		add_rewrite_rule('(news)/([12]\d{3})/?$', 'index.php?post_type=$matches[1]&year=$matches[2]', 'top');
		add_rewrite_rule('(news)/([12]\d{3})/page/(\d+)/?$', 'index.php?post_type=$matches[1]&year=$matches[2]&paged=$matches[3]', 'top');
		add_rewrite_rule('(news)/([12]\d{3})/(.+?)/page/(\d+)/?$', 'index.php?post_type=$matches[1]&year=$matches[2]&cat_news=$matches[3]&paged=$matches[4]', 'top');
		add_rewrite_rule('(news)/(.+?)/page/(\d+)/?$', 'index.php?post_type=$matches[1]&cat_news=$matches[2]&paged=$matches[3]', 'top');
		add_rewrite_rule('(news)/([12]\d{3})/(.+?)/?$', 'index.php?post_type=$matches[1]&year=$matches[2]&cat_news=$matches[3]', 'top');


		// コラム
		register_post_type('visitor',
			array(
				'labels' => array(
					'name' => __('進路・進学コラム'),
					'singular_name' => __('進路・進学コラム'),
					'menu_name' => '進路・進学コラム'
				),
				'rewrite' => array(
					'slug' => 'visitor',
					'with_front' => false
				),
				'hierarchical' => false,
				'has_archive' => true,
				'menu_position' => 22,
				'public' => true,
				"supports" => [ "title", "editor", "thumbnail" ],
			)
		);

	});


	// 年度が切り替わるデフォルトの月
	define('ODA_NEW_YEAR_FIRST_MONTH_DEFAULT', 4);

	/**
	 * 年別アーカイブを年度別アーカイブにする
	 */
	add_action('pre_get_posts', function($query) {

		/** @var WP_Query $query */
		if (is_admin() || !$query->is_main_query() || is_preview()) {
			return;
		}

		$post_type = $query->get('post_type');

		if( $post_type==='news' && $query->is_year() ) {

			$year = $query->get('year');

			$query->set('year', null);

			$new_year_first_month = ODA_NEW_YEAR_FIRST_MONTH_DEFAULT;

			$first_date = new DateTime();
			$first_date->setDate($year, $new_year_first_month, 1);

			$last_date = new DateTime();
			$last_date->setDate($year+1, $new_year_first_month, 0);

			$query->set('date_query', array(
				array(
					'after'     => array(
						'year'  => $first_date->format('Y'),
						'month' => $first_date->format('n'),
						'day'   => $first_date->format('j'),
					),
					'before'    => array(
						'year'  => $last_date->format('Y'),
						'month' => $last_date->format('n'),
						'day'   => $last_date->format('j'),
					),
					'inclusive' => true,
				),
			));

			$query->set('raw_year', $year);

			return;

		}

	});


	/**
	 * 年度別アーカイブリンク
	 *
	 * @param $year int|string 年度
	 * @param int|string|WP_Term $term
	 * @param string $taxonomy
	 * @return string URL
	 */
	function oda_get_archive_link($year=null, $term=null){

		if( !$year && !$term ) return esc_html(home_url('/')).'news/';

		if(is_numeric($term)) $term = get_term($term, 'news');
		if($term instanceof WP_Term) $term = $term->slug;

		return esc_html(home_url('/')).'news/'.($year? strval($year).'/': '').($term? strval($term).'/': '');

	}


	/**
	 * 年度別アーカイブリスト
	 *
	 * @param string $order
	 * @return array
	 */
	function oda_news_get_yearly_archives($order='ASC'){

		//年度が切り替わる月
		$new_year_first_month = ODA_NEW_YEAR_FIRST_MONTH_DEFAULT;

		//通常の年別アーカイブとは区切りが異なるので一旦月別で取得
		$monthly = array_filter(array_map('trim', explode("\n", wp_get_archives(array(
			'type'      => 'monthly',
			'post_type' => 'news',
			'format'    => 'custom',
			'echo'      => false
		)))));

		$yearly = array();

		foreach($monthly as $month){

			if(!preg_match('/(\d+)年(\d+)月/u', $month, $matches)) continue;

			$year  = intval($matches[1]);
			$month = intval($matches[2]);

			//年度切り替え前なら 1 引いて前年度にする
			if($month<$new_year_first_month){
				$year = $year - 1;
			}

			if(!isset($yearly[$year])){
				$yearly[$year] = oda_get_archive_link($year);
			}

		}

		if($order==='DESC'){
			krsort($yearly);
		}else{
			ksort($yearly);
		}

		return $yearly;

	}
