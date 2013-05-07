<?php
/*
Template Name: archives
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
		<div class="info">
			<span class="date"><?php the_modified_time(__('F jS, Y', 'inove')); ?></span>
			<?php edit_post_link(__('Edit', 'inove'), '<span class="editpost">', '</span>'); ?>
			<?php if ($comments || comments_open()) : ?>
				<span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'inove'); ?></a></span>
				<span class="comments"><a href="#comments"><?php _e('Go to comments', 'inove'); ?></a></span>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
		<div class="content">
			<?php the_content(); ?>
			<div style="clear:both; margin-top:5px; margin-bottom:5px;"></div><div style="float:left"><!-- JiaThis Button BEGIN -->
				<div class="jiathis_style">
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_tqq"></a>
				<a class="jiathis_button_tsohu"></a>
				<a class="jiathis_button_t163"></a>
				<a class="jiathis_button_douban"></a>
				<a class="jiathis_button_renren"></a>
				<a class="jiathis_button_zhuaxia"></a>
				<a class="jiathis_button_fanfou"></a>
				<a class="jiathis_button_twitter"></a>
				<a class="jiathis_button_fb"></a>
				<a class="jiathis_button_gmail"></a>
				<a class="jiathis_button_linkedin"></a>
				<a class="jiathis_button_friendfeed"></a>
				<a class="jiathis_button_digg"></a>
				<a href="http://www.jiathis.com/share?uid=1354603037288510" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
				<a class="jiathis_counter_style"></a>
				</div>
				<script type="text/javascript" >
				var jiathis_config={
					data_track_clickback:true,
					summary:"",
					hideMore:false
				}
				</script>
				<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1354603037288510" charset="utf-8"></script>
				<!-- JiaThis Button END --></div>
				<div style="clear:both; margin-top:5px; margin-bottom:5px;"></div>
			<?php
$previous_year = $year = 0;
$previous_month = $month = 0;
$ul_open = false;

$myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
?>

<?php foreach($myposts as $post) : ?>
<?php
setup_postdata($post);
$year = mysql2date('Y', $post->post_date);
$month = mysql2date('n', $post->post_date);
$day = mysql2date('j', $post->post_date);
?>
<?php $previous_year = $year; $previous_month = $month; ?>
<li><?php the_time('Y/m/d'); ?> <a href="<?php the_permalink(); ?>"  rel="bookmark" ><?php the_title(); ?></a> <?php if(function_exists('the_views')) { ?>(<?php the_views();?>)<?php } ?> — <?php the_author(); ?></li><?php endforeach; ?>
			<div class="fixed"></div>
		</div>
	</div>
	<?php include('templates/comments.php'); ?>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'inove'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
