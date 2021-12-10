<?php

/**
 * 定义常量
 */
define('CSS_HOME',get_template_directory_uri() . '/asset/css/');
define('JS_HOME',get_template_directory_uri() . '/asset/js/');
define('ROOT_URI',get_template_directory_uri() . '/');
define('VERSION','1.0');

// 加载各种功能
require_once plugin_dir_path(__FILE__) . '/widget/WidgetAuthor.php';
require_once plugin_dir_path(__FILE__) . '/widget/WidgetRecommendPosts.php';
require_once plugin_dir_path(__FILE__) . '/widget/WidgetSearch.php';
require_once plugin_dir_path(__FILE__) . '/widget/WidgetTagCloud.php';

require_once plugin_dir_path(__FILE__) . '/lib/helper.php';
require_once plugin_dir_path(__FILE__) . '/lib/query.php';
require_once plugin_dir_path(__FILE__) . '/lib/htmlGetter.php';

require_once plugin_dir_path(__FILE__) . '/lib/ajax.php';

/**
 * 加载css js
 */
function load_common_js_css(){
  wp_enqueue_style('my-common', CSS_HOME . 'common.css',  [], VERSION, 'all');
  wp_enqueue_script('my-common', JS_HOME . 'common.js',[],VERSION,true);
}

function load_difference_css_js(){
  if(is_home()){
    wp_enqueue_style('index', CSS_HOME . 'index.css',  ['my-common'], VERSION, 'all');
    wp_enqueue_script('index', JS_HOME . 'index.js',['my-common'],VERSION,true);
  }else if(is_category()){
    wp_enqueue_style('category', CSS_HOME . 'category.css',  ['my-common'], VERSION, 'all');
    wp_enqueue_script('category', JS_HOME . 'category.js',['my-common'],VERSION,true);
  }else if(is_single()){
    wp_enqueue_style('post', CSS_HOME . 'post.css',  ['my-common'], VERSION, 'all');
    wp_enqueue_script('post', JS_HOME . 'post.js',['my-common'],VERSION,true);
  }else if(is_search()){
    wp_enqueue_style('search', CSS_HOME . 'search.css',  ['my-common'], VERSION, 'all');
    wp_enqueue_script('search', JS_HOME . 'search.js',['my-common'],VERSION,true);
  }else if(is_tag()){
    wp_enqueue_style('tag', CSS_HOME . 'tag.css',  ['my-common'], VERSION, 'all');
    wp_enqueue_script('tag', JS_HOME . 'tag.js',['my-common'],VERSION,true);
  }
}

function load_css_js() {
  load_common_js_css();
  load_difference_css_js();
}
add_action('wp_enqueue_scripts', 'load_css_js');


/**
 * 注册小工具栏目
 */
function registe_widget_section() {

  // 右边栏
  register_sidebar(
    [
      'name' => '右侧栏',
      'id' => 'right-sidebar',
      'before_widget' => '<div class="mb-2">',
      'after_widget' => '</div>',
      'before_title' => '',
      'after_title' => '',
    ]
  );

}


add_action( 'widgets_init', 'registe_widget_section' );

/**
 * 注册小工具
 */
function registe_widget_list() {
  register_widget( 'WidgetAuthor' );
  register_widget( 'WidgetRecommendPosts' );
  register_widget( 'WidgetSearch' );
  register_widget('WidgetTagCloud');
}
add_action( 'widgets_init', 'registe_widget_list' );



/**
 * 禁用古腾堡编辑器
 */
// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


/**
 * 修改wordpress样式
 */
// 修改excerpt结尾
function new_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * 功能增强
 */
//更新文章浏览量
function updatePostViewCount(){
  if (!is_singular()){
    return;
  }
  global $post;
  $postId = $post->ID;
  if(!$postId){
    return;
  }
  $oldView = (int)get_post_meta($postId,'view',true);
  // if(!$oldView){
  //   delete_post_meta($postId,'view');
  //   add_post_meta($postId,'view',0);
  //   $oldView = 0;
  // }
  update_post_meta($postId, 'view', ($oldView+1));
}
add_action('wp_head', 'updatePostViewCount');


/**
 * 注册菜单
 */

function registe_menu(){ 
  // 注册菜单
  register_nav_menu( 'primary', '顶部主菜单' );
}
add_action( 'after_setup_theme', 'registe_menu' );



// /**
//  * 文章点赞
//  */
// function q1_post_like_callback(){
//   global $wpdb,$post;
//   $id = $_POST["postId"];
//   // $action = $_POST["action"];
//   $q1_post_like_count= get_post_meta($id,'q1_post_like_count',true);
//   $expire = time() + 99999999;
//   $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
//   setcookie('q1_post_like_'.$id,$id,$expire,'/',$domain,false);
//   if (!$q1_post_like_count || !is_numeric($q1_post_like_count)) {
//     update_post_meta($id, 'q1_post_like_count', 1);
//   }else {
//     update_post_meta($id, 'q1_post_like_count', ($q1_post_like_count + 1));
//   }
//   echo get_post_meta($id,'q1_post_like_count',true);
//   die;
// }
// add_action('wp_ajax_nopriv_q1_post_like_action', 'q1_post_like_callback');
// add_action('wp_ajax_q1_post_like_action', 'q1_post_like_callback');