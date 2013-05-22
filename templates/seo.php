<?php if ( is_home() ) { ?>
<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
<?php } ?>
<?php if ( is_search() ) { ?>
<title><?php printf('%1$s 的搜索结果', wp_specialchars($s, 1)); ?> | <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_single() ) { ?>
<title><?php echo trim(wp_title('',0)); ?><?php if (get_query_var('page')) { echo '-第'; echo get_query_var('page'); echo '页';}?> | <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_page() ) { ?>
<title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_category() ) { ?>
<title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_year() ) { ?>
<title><?php the_time('Y年'); ?>日志归档 | <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_month() ) { ?>
<title><?php the_time('Y年n月'); ?>日志归档 | <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_day() ) { ?>
<title><?php the_time('Y年n月j日'); ?>日志归档 | <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?>
<title><?php  single_tag_title("", true); ?> | <?php bloginfo('name'); ?></title>
<?php } ?><?php } ?>
<?php
	$options = get_option('linove_options');
	if ($options['function_seo']) {
?>
	<?php
if (!function_exists('utf8Substr')) {
	 function utf8Substr($str, $from, $len)
	 {
	     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
	      '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
	      '$1',$str);
	 }
}
if ( is_single() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
   if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
    $post_content = $result['1'];
   } else {
    $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
    $post_content = $post_content_r['0'];
   }
         $description = utf8Substr($post_content,0,220);  
  } 
    $keywords = "";     
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}else if( is_home()){
	$options = get_option('linove_options');
	$description = $options['seo_description'];
	$keywords = $options['seo_keywords'];
}
?>
<?php if ( is_single() ) { ?>
	<meta name="description" content="<?php echo trim($description); ?>" />
	<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_home() ) { ?>
	<meta name="description" content="<?php echo get_option('linove_description'); ?>" />
	<meta name="keywords" content="<?php echo get_option('swt_keywords'); ?>" />
<?php } ?>
<?php if ( is_category() ) { ?>
	<meta name="description" content="<?php echo strip_tags(category_description($cat_ID)); ?>" />
	<meta name="keywords" content="<?php echo get_option('swt_keywords'); ?>" />
<?php } ?>
<?php if ( is_tag() ) { ?>
	<meta name="description" content="<?php bloginfo('name'); ?>上关于<?php echo single_tag_title(); ?>的所有日志聚合" />
<?php } ?>
<?php if ( is_year() ) { ?>
	<meta name="description" content="<?php bloginfo('name'); ?>上<?php the_time('Y年'); ?>发布的所有日志聚合" />
<?php } ?>
<?php if ( is_month() ) { ?>
	<meta name="description" content="<?php bloginfo('name'); ?>上<?php the_time('Y年n月'); ?>份发布的所有日志聚合" />
<?php } ?>
<?php if ( is_day() ) { ?>
	<meta name="description" content="<?php bloginfo('name'); ?>博客上<?php the_time('Y年n月j日'); ?>发布的所有日志聚合" />
<?php } ?>
<?php
	} 
?>