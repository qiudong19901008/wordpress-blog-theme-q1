
<div class="comment-list-container">
  <?php 
    get_template_part('frontend/post/commentSection/commentSection'); 
  ?>
</div>















<?php
// $res = CommentDao::query(71,'comment_date','DESC',1,10);
// var_dump($res);

// $arr = [
//   'categoryId'=>null,
// ];

// $res = empty($arr['categoryId']);

// $res = admin_url('admin-ajax.php');

// $query = new WP_Query([
//   'post_type'=>'post',
//   'post_status'=>'publish',
//   'posts_per_page'=>1,
// ]);

// if($query->have_posts()){
//   while($query->have_posts()){
//     $query->the_post();
//     global $post;
//     var_dump($post);
//   }
// }
// q1_field_post_view_count
// $res = PostMetaDao::getPostMetaListByPostIdList([71],[
//   Fields::COUNT_POST_LIKE,
//   Fields::COUNT_POST_VIEW,
// ]);

// $res = substr("('abc','bdk',",0,-1);

// $res = PostDao::queryPostList([],null,[71],['meta','author','category'],[Fields::COUNT_POST_LIKE,Fields::COUNT_POST_VIEW],'create_time','DESC',1,1);

// $res = get_categories(); //默认只会查出有文章的分类

// get_category_link(9)


// var_dump($res);
// echo $res;

// $listAndCount = PostDao::queryPostList(
//   [],
//   null,
//   [101],
//   ['meta','author','category','tag'],
//   [
//     Fields::COUNT_POST_LIKE,
//     Fields::COUNT_POST_VIEW,
//   ],
// );
$res = PostDao::queryRecommendPostList('like',6);

var_dump($res);

// var_dump($listAndCount);

?>


