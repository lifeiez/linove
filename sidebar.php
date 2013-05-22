<?php
	$options = get_option('linove_options');

	if($options['feed'] && $options['feed_url']) {
		if (substr(strtoupper($options['feed_url']), 0, 7) == 'HTTP://') {
			$feed = $options['feed_url'];
		} else {
			$feed = 'http://' . $options['feed_url'];
		}
	} else {
		$feed = get_bloginfo('rss2_url');
	}
?>

<!-- sidebar START -->
<div id="sidebar">
<!-- sidebar top START -->
<div id="sidebartop" class="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_top') ) : ?>
	<?php 
		$options = get_option('linove_options');
		if ($options['function_feeds']) {
	?>
	<!-- feeds -->
	<div class="widget widget_feeds">
		<div class="content">
			<div id="subscribe">
				<a rel="external nofollow" id="feedrss" title="<?php _e('Subscribe to this blog...', 'inove'); ?>" href="<?php echo $feed; ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'inove'); ?></a>
				<?php if($options['feed_readers']) : ?>
					<ul id="feed_readers">
						<li id="google_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Google', 'inove'); ?>" href="http://fusion.google.com/add?feedurl=<?php echo $feed; ?>"><span><?php _e('Google', 'inove'); ?></span></a></li>
						<li id="youdao_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Youdao', 'inove'); ?>" href="http://reader.youdao.com/#url=<?php echo $feed; ?>"><span><?php _e('Youdao', 'inove'); ?></span></a></li>
						<li id="xianguo_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Xian Guo', 'inove'); ?>" href="http://www.xianguo.com/subscribe.php?url=<?php echo $feed; ?>"><span><?php _e('Xian Guo', 'inove'); ?></span></a></li>
						<li id="zhuaxia_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Zhua Xia', 'inove'); ?>" href="http://www.zhuaxia.com/add_channel.php?url=<?php echo $feed; ?>"><span><?php _e('Zhua Xia', 'inove'); ?></span></a></li>
						<li id="yahoo_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('My Yahoo!', 'inove'); ?>"	href="http://add.my.yahoo.com/rss?url=<?php echo $feed; ?>"><span><?php _e('My Yahoo!', 'inove'); ?></span></a></li>
						<li id="newsgator_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('newsgator', 'inove'); ?>"	href="http://www.newsgator.com/ngs/subscriber/subfext.aspx?url=<?php echo $feed; ?>"><span><?php _e('newsgator', 'inove'); ?></span></a></li>
						<li id="bloglines_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Bloglines', 'inove'); ?>"	href="http://www.bloglines.com/sub/<?php echo $feed; ?>"><span><?php _e('Bloglines', 'inove'); ?></span></a></li>
						<li id="inezha_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('iNezha', 'inove'); ?>"	href="http://inezha.com/add?url=<?php echo $feed; ?>"><span><?php _e('iNezha', 'inove'); ?></span></a></li>
						<li id="qq_reader"><a rel="external nofollow"  class="reader" title="订阅到QQ Mail" onclick="window.open(this.href);return false;"  href="http://mail.qq.com/cgi-bin/feed?u=<?php echo $feed; ?>"><span>QQ Mail</span></a></li>
            			<li id="douban_reader"><a class="reader" title="订阅到Douban" onclick="window.open(this.href);return false;" rel="external nofollow" href="http://9.douban.com/reader/subscribe?url=<?php echo $feed; ?>"><span>Douban</span></a></li>
            			<li id="rojo_reader"><a class="reader" title="订阅到Rojo" onclick="window.open(this.href);return false;" rel="external nofollow" href="http://www.rojo.com/add-subscription?resource=<?php echo $feed; ?>"><span></span></a></li>
            			<li id="pageflakes_reader"><a class="reader" title="订阅到Pageflakes" onclick="window.open(this.href);return false;" rel="external nofollow" href="http://www.pageflakes.com/subscribe.aspx?url=<?php echo $feed; ?>"><span>Pageflakes</span></a></li>
					</ul>
				<?php endif; ?>
			</div>
			<?php if($options['feed_email'] && $options['feed_url_email']) : ?>
				<a rel="external nofollow" id="feedemail" title="<?php _e('Subscribe to this blog via email...', 'linove'); ?>" href="<?php echo $options['feed_url_email']; ?>"><?php _e('Email feed', 'linove'); ?></a>
			<?php endif; if($options['twitter'] && $options['twitter_username']) : ?>
				<a id="followme" title="<?php _e('Follow me!', 'linove'); ?>" href="http://twitter.com/<?php echo $options['twitter_username']; ?>/"><?php _e('Twitter', 'linove'); ?></a>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
	</div>
	<?php 
		}
	?>
	
	<?php if( $options['showcase_content'] && (
		($options['showcase_registered'] && $user_ID) || 
		($options['showcase_commentator'] && !$user_ID && isset($_COOKIE['comment_author_'.COOKIEHASH])) || 
		($options['showcase_visitor'] && !$user_ID && !isset($_COOKIE['comment_author_'.COOKIEHASH]))
	) ) : ?>
		<!-- showcase -->
		<div class="widget widget_showcase">
			<?php if($options['showcase_caption']) : ?>
				<h3><?php if($options['showcase_title']){echo($options['showcase_title']);}else{_e('Showcase', 'linove');} ?></h3>
			<?php endif; ?>
			<div class="content">
				<?php echo($options['showcase_content']); ?>
			</div>
		</div>
	<?php endif; ?>
	
	<!-- Recent Comments -->
	<?php if( function_exists('wp_recentcomments') ) : ?>
		<div class="widget">
			<h3>最近回复</h3>
			<ul>
				<?php wp_recentcomments('limit=5&length=16&post=false&smilies=true'); ?>
			</ul>
		</div>
	<?php endif; ?>
	<!-- Tag Cloud -->
	<div id="tag_cloud" class="widget">
		<h3>标签云</h3>
		<?php wp_tag_cloud('smallest=8&largest=16'); ?>
	</div>
	<!-- blogroll -->
	<div class="widget widget_links">
		<h3>Blogroll</h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
		</ul>
	</div>
	<?php endif; ?>
</div>
<!-- sidebar top END -->
<!-- sidebar follow START -->
<div id="sidebarfollow"  class="sidebar" >
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_follow') ) : ?>
<?php endif; ?>
	<?php
		if ($options['function_related_articles']) {
			if (is_single()) {
				$posts_widget_title = '相关文章';
			} else {
				$posts_widget_title = '随机文章';
			}
	?>
	<div class="widget"  >
		<h3><?php echo $posts_widget_title; ?></h3>
		<ul>
			<?php
				if (is_single()) {
global $post;
$cats = wp_get_post_categories($post->ID);
if ($cats) {
    $args = array (
        'category__in' => array (
            $cats[0]
   		     ),
        'post__not_in' => array (
            $post->ID
        ),
        'showposts' => 6,
        'caller_get_posts' => 1
    );
    query_posts($args);

    if (have_posts()) {
        while (have_posts()) {
            the_post();
            update_post_caches($posts);
?>
  <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php		
		}
	} else {
			echo '<li>暂无相关文章</li>';
		}
		wp_reset_query();
	} else {
			echo '<li>暂无相关文章</li>';
		}
				} else {
					$posts = get_posts('numberposts=6&orderby=rand');
					foreach($posts as $post) {
					setup_postdata($post);
					echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
					}
				}
				$post = $posts[0];
			?>
		</ul>
	</div>
	
<?php
		}
	  ?>
	<?php 
	if ($options['function_history_view']) { 
	?>
	<div class="widget" id="linove_viewHistory" >
		<h3>您刚刚看过</h3>
	</div>
	<?php 
		} 
	?>
</div>
<!-- sidebar follow END -->

</div>
<!-- sidebar END -->
