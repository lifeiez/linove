<?php

/** linove options */
class linoveOptions {

	function getOptions() {
		$options = get_option('linove_options');
		if (!is_array($options)) {
			$options['google_cse'] = false;
			$options['google_cse_cx'] = '';
			$options['menu_type'] = 'pages';
			$options['nosidebar'] = false;
			$options['notice'] = false;
			$options['notice_content'] = '';
			$options['banner_registered'] = false;
			$options['banner_commentator'] = false;
			$options['banner_visitor'] = false;
			$options['banner_content'] = '';
			$options['showcase_registered'] = false;
			$options['showcase_commentator'] = false;
			$options['showcase_visitor'] = false;
			$options['showcase_caption'] = false;
			$options['showcase_title'] = '';
			$options['showcase_content'] = '';
			$options['author'] = true;
			$options['categories'] = true;
			$options['tags'] = true;
			$options['ctrlentry'] = false;
			$options['feed_readers'] = true;
			$options['feed'] = false;
			$options['feed_url'] = '';
			$options['feed_email'] = false;
			$options['feed_url_email'] = '';
			$options['twitter'] = false;
			$options['twitter_username'] = '';
			$options['analytics'] = false;
			$options['analytics_content'] = '';
			update_option('linove_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['linove_save'])) {
			$options = linoveOptions::getOptions();

			// google custom search engine
			if ($_POST['google_cse']) {
				$options['google_cse'] = (bool)true;
			} else {
				$options['google_cse'] = (bool)false;
			}
			$options['google_cse_cx'] = stripslashes($_POST['google_cse_cx']);

			// menu
			$options['menu_type'] = stripslashes($_POST['menu_type']);

			// sidebar
			if ($_POST['nosidebar']) {
				$options['nosidebar'] = (bool)true;
			} else {
				$options['nosidebar'] = (bool)false;
			}

			// notice
			if ($_POST['notice']) {
				$options['notice'] = (bool)true;
			} else {
				$options['notice'] = (bool)false;
			}
			$options['notice_content'] = stripslashes($_POST['notice_content']);

			// banner
			if (!$_POST['banner_registered']) {
				$options['banner_registered'] = (bool)false;
			} else {
				$options['banner_registered'] = (bool)true;
			}
			if (!$_POST['banner_commentator']) {
				$options['banner_commentator'] = (bool)false;
			} else {
				$options['banner_commentator'] = (bool)true;
			}
			if (!$_POST['banner_visitor']) {
				$options['banner_visitor'] = (bool)false;
			} else {
				$options['banner_visitor'] = (bool)true;
			}
			$options['banner_content'] = stripslashes($_POST['banner_content']);

			// showcase
			if (!$_POST['showcase_registered']) {
				$options['showcase_registered'] = (bool)false;
			} else {
				$options['showcase_registered'] = (bool)true;
			}
			if (!$_POST['showcase_commentator']) {
				$options['showcase_commentator'] = (bool)false;
			} else {
				$options['showcase_commentator'] = (bool)true;
			}
			if (!$_POST['showcase_visitor']) {
				$options['showcase_visitor'] = (bool)false;
			} else {
				$options['showcase_visitor'] = (bool)true;
			}
			if ($_POST['showcase_caption']) {
				$options['showcase_caption'] = (bool)true;
			} else {
				$options['showcase_caption'] = (bool)false;
			}
			$options['showcase_title'] = stripslashes($_POST['showcase_title']);
			$options['showcase_content'] = stripslashes($_POST['showcase_content']);

			// posts
			if ($_POST['author']) {
				$options['author'] = (bool)true;
			} else {
				$options['author'] = (bool)false;
			}
			if ($_POST['categories']) {
				$options['categories'] = (bool)true;
			} else {
				$options['categories'] = (bool)false;
			}
			if (!$_POST['tags']) {
				$options['tags'] = (bool)false;
			} else {
				$options['tags'] = (bool)true;
			}

			// ctrl + entry
			if ($_POST['ctrlentry']) {
				$options['ctrlentry'] = (bool)true;
			} else {
				$options['ctrlentry'] = (bool)false;
			}

			// feed
			if (!$_POST['feed_readers']) {
				$options['feed_readers'] = (bool)false;
			} else {
				$options['feed_readers'] = (bool)true;
			}
			if ($_POST['feed']) {
				$options['feed'] = (bool)true;
			} else {
				$options['feed'] = (bool)false;
			}
			$options['feed_url'] = stripslashes($_POST['feed_url']);
			if ($_POST['feed_email']) {
				$options['feed_email'] = (bool)true;
			} else {
				$options['feed_email'] = (bool)false;
			}
			$options['feed_url_email'] = stripslashes($_POST['feed_url_email']);

			// twitter
			if ($_POST['twitter']) {
				$options['twitter'] = (bool)true;
			} else {
				$options['twitter'] = (bool)false;
			}
			$options['twitter_username'] = stripslashes($_POST['twitter_username']);

			// analytics
			if ($_POST['analytics']) {
				$options['analytics'] = (bool)true;
			} else {
				$options['analytics'] = (bool)false;
			}
			$options['analytics_content'] = stripslashes($_POST['analytics_content']);

			update_option('linove_options', $options);

		} else {
			linoveOptions::getOptions();
		}

		add_theme_page(__('Current Theme Options', 'linove'), __('Current Theme Options', 'linove'), 'edit_themes', basename(__FILE__), array('linoveOptions', 'display'));
	}

	function display() {
		$options = linoveOptions::getOptions();
?>

<form action="#" method="post" enctype="multipart/form-data" name="linove_form" id="linove_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'linove'); ?></h2>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Search', 'linove'); ?></th>
					<td>
						<label>
							<input name="google_cse" type="checkbox" value="checkbox" <?php if($options['google_cse']) echo "checked='checked'"; ?> />
							 <?php _e('Using google custom search engine.', 'linove'); ?>
						</label>
						<br/>
						<?php _e('CX:', 'linove'); ?>
						 <input type="text" name="google_cse_cx" id="google_cse_cx" class="code" size="40" value="<?php echo($options['google_cse_cx']); ?>">
						<br/>
						<?php printf(__('Find <code>name="cx"</code> in the <strong>Search box code</strong> of <a href="%1$s">Google Custom Search Engine</a>, and type the <code>value</code> here.<br/>For example: <code>014782006753236413342:1ltfrybsbz4</code>', 'linove'), 'http://www.google.com/coop/cse/'); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Menubar', 'linove'); ?></th>
					<td>
						<label style="margin-right:20px;">
							<input name="menu_type" type="radio" value="pages" <?php if($options['menu_type'] != 'categories') echo "checked='checked'"; ?> />
							 <?php _e('Show pages as menu.', 'linove'); ?>
						</label>
						<label>
							<input name="menu_type" type="radio" value="categories" <?php if($options['menu_type'] == 'categories') echo "checked='checked'"; ?> />
							 <?php _e('Show categories as menu.', 'linove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Sidebar', 'linove'); ?></th>
					<td>
						<label>
							<input name="nosidebar" type="checkbox" value="checkbox" <?php if($options['nosidebar']) echo "checked='checked'"; ?> />
							 <?php _e('Hide sidebar from all pages.', 'linove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Notice', 'linove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'linove'); ?></small>
					</th>
					<td>
						<!-- notice START -->
						<label>
							<input name="notice" type="checkbox" value="checkbox" <?php if($options['notice']) echo "checked='checked'"; ?> />
							 <?php _e('This notice bar will display at the top of posts on homepage.', 'linove'); ?>
						</label>
						<br />
						<label>
							<textarea name="notice_content" id="notice_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['notice_content']); ?></textarea>
						</label>
						<!-- notice END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Banner', 'linove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'linove'); ?></small>
					</th>
					<td>
						<!-- banner START -->
						<?php _e('This banner will display at the right of header. (height: 60 pixels)', 'linove'); ?>
						<br/>
						<?php _e('Who can see?', 'linove'); ?>
						<label style="margin-left:10px;">
							<input name="banner_registered" type="checkbox" value="checkbox" <?php if($options['banner_registered']) echo "checked='checked'"; ?> />
							 <?php _e('Registered Users', 'linove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="banner_commentator" type="checkbox" value="checkbox" <?php if($options['banner_commentator']) echo "checked='checked'"; ?> />
							 <?php _e('Commentator', 'linove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="banner_visitor" type="checkbox" value="checkbox" <?php if($options['banner_visitor']) echo "checked='checked'"; ?> />
							 <?php _e('Visitors', 'linove'); ?>
						</label>
						<br/>
						<label>
							<textarea name="banner_content" id="banner_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['banner_content']); ?></textarea>
						</label>
						<!-- banner END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Showcase', 'linove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'linove'); ?></small>
					</th>
					<td>
						<!-- showcase START -->
						<?php _e('This showcase will display at the top of sidebar.', 'linove'); ?>
						<br/>
						<?php _e('Who can see?', 'linove'); ?>
						<label style="margin-left:10px;">
							<input name="showcase_registered" type="checkbox" value="checkbox" <?php if($options['showcase_registered']) echo "checked='checked'"; ?> />
							 <?php _e('Registered Users', 'linove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="showcase_commentator" type="checkbox" value="checkbox" <?php if($options['showcase_commentator']) echo "checked='checked'"; ?> />
							 <?php _e('Commentator', 'linove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="showcase_visitor" type="checkbox" value="checkbox" <?php if($options['showcase_visitor']) echo "checked='checked'"; ?> />
							 <?php _e('Visitors', 'linove'); ?>
						</label>
						<br/>
						<label>
							<input name="showcase_caption" type="checkbox" value="checkbox" <?php if($options['showcase_caption']) echo "checked='checked'"; ?> />
							 <?php _e('Title:', 'linove'); ?>
						</label>
						 <input type="text" name="showcase_title" id="showcase_title" class="code" size="40" value="<?php echo($options['showcase_title']); ?>" />
						<br/>
						<label>
							<textarea name="showcase_content" id="showcase_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['showcase_content']); ?></textarea>
						</label>
						<!-- showcase END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Posts', 'linove'); ?></th>
					<td>
						<label style="margin-right:20px;">
							<input name="author" type="checkbox" value="checkbox" <?php if($options['author']) echo "checked='checked'"; ?> />
							 <?php _e('Show author on posts.', 'linove'); ?>
						</label>
						<label style="margin-right:20px;">
							<input name="categories" type="checkbox" value="checkbox" <?php if($options['categories']) echo "checked='checked'"; ?> />
							 <?php _e('Show categories on posts.', 'linove'); ?>
						</label>
						<label>
							<input name="tags" type="checkbox" value="checkbox" <?php if($options['tags']) echo "checked='checked'"; ?> />
							 <?php _e('Show tags on posts.', 'linove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Comments', 'linove'); ?></th>
					<td>
						<label>
							<input name="ctrlentry" type="checkbox" value="checkbox" <?php if($options['ctrlentry']) echo "checked='checked'"; ?> />
							 <?php _e('Submit comments with Ctrl+Enter.', 'linove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Feed', 'linove'); ?></th>
					<td>
						<label>
							<input name="feed_readers" type="checkbox" value="checkbox" <?php if($options['feed_readers']) echo "checked='checked'"; ?> />
							 <?php _e('Show the feed reader list when mouse over on feed button.', 'linove'); ?>
						</label>
						<br />
						<label>
							<input name="feed" type="checkbox" value="checkbox" <?php if($options['feed']) echo "checked='checked'"; ?> />
							 <?php _e('Custom feed.', 'linove'); ?>
						</label>
						 <?php _e('URL:', 'linove'); ?> <input type="text" name="feed_url" id="feed_url" class="code" size="60" value="<?php echo($options['feed_url']); ?>">
						<br/>
						<label>
							<input name="feed_email" type="checkbox" value="checkbox" <?php if($options['feed_email']) echo "checked='checked'"; ?> />
							 <?php _e('Email feed.', 'linove'); ?>
						</label>
						 <?php _e('URL:', 'linove'); ?> <input type="text" name="feed_url_email" id="feed_url_email" class="code" size="60" value="<?php echo($options['feed_url_email']); ?>">
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Twitter', 'linove'); ?></th>
					<td>
						<label>
							<input name="twitter" type="checkbox" value="checkbox" <?php if($options['twitter']) echo "checked='checked'"; ?> />
							 <?php _e('Add Twitter button.', 'linove'); ?>
						</label>
						<br />
						 <?php _e('Twitter username:', 'linove'); ?>
						 <input type="text" name="twitter_username" id="twitter_username" class="code" size="40" value="<?php echo($options['twitter_username']); ?>">
						<br />
						<a href="http://twitter.com/neoease/" onclick="window.open(this.href);return false;">Follow NeoEase</a>
						 | <a href="http://twitter.com/mg12/" onclick="window.open(this.href);return false;">Follow MG12</a>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Web Analytics', 'linove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'linove'); ?></small>
					</th>
					<td>
						<label>
							<input name="analytics" type="checkbox" value="checkbox" <?php if($options['analytics']) echo "checked='checked'"; ?> />
							 <?php _e('Add web analytics code to your site. (e.g. Google Analytics, Yahoo! Web Analytics, ...)', 'linove'); ?>
						</label>
						<label>
							<textarea name="analytics_content" cols="50" rows="10" id="analytics_content" class="code" style="width:98%;font-size:12px;"><?php echo($options['analytics_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input class="button-primary" type="submit" name="linove_save" value="<?php _e('Save Changes', 'linove'); ?>" />
		</p>
	</div>
</form>

<!-- donation -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<div class="wrap" style="background:#E3E3E3; margin-bottom:1em;">

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">Donation</th>
					<td>
						If you find my work useful and you want to encourage the development of more free resources, you can do it by donating...
						<br />
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
						<input style="border:none;" type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" name="submit" alt="" />
						<img alt="" src="https://www.paypal.com/zh_XC/i/scr/pixel.gif" />
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</form>

<?php
	}
}

// register functions
add_action('admin_menu', array('linoveOptions', 'add'));


/** l10n */
function theme_init(){
	load_theme_textdomain('linove', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

/** widgets */
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'north_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'south_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'west_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'east_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

/** Comments */
if (function_exists('wp_list_comments')) {
	// comment count
	function comment_count( $commentcount ) {
		global $id;
		$_comments = get_comments('status=approve&post_id=' . $id);
		$comments_by_type = &separate_comments($_comments);
		return count($comments_by_type['comment']);
	}
}

// custom comments
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>
	<li class="comment <?php if($comment->comment_author_email == get_the_author_email()) {echo 'admincomment';} else {echo 'regularcomment';} ?>" id="comment-<?php comment_ID() ?>">
		<div class="author">
			<div class="pic">
				<?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 32); } ?>
			</div>
			<div class="name">
				<?php if (get_comment_author_url()) : ?>
					<a id="commentauthor-<?php comment_ID() ?>" class="url" href="<?php comment_author_url() ?>" rel="external nofollow">
				<?php else : ?>
					<span id="commentauthor-<?php comment_ID() ?>">
				<?php endif; ?>

				<?php comment_author(); ?>

				<?php if(get_comment_author_url()) : ?>
					</a>
				<?php else : ?>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div class="info">
			<div class="date">
				<?php printf( __('%1$s at %2$s', 'linove'), get_comment_time(__('F jS, Y', 'linove')), get_comment_time(__('H:i', 'linove')) ); ?>
					 | <a href="#comment-<?php comment_ID() ?>"><?php printf('#%1$s', ++$commentcount); ?></a>
			</div>
			<div class="act">
				<a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('Reply', 'linove'); ?></a> | 
				<a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'commentbody-<?php comment_ID() ?>', 'comment');"><?php _e('Quote', 'linove'); ?></a>
				<?php
					if (function_exists("qc_comment_edit_link")) {
						qc_comment_edit_link('', ' | ', '', __('Edit', 'linove'));
					}
					edit_comment_link(__('Advanced edit', 'linove'), ' | ', '');
				?>
			</div>
			<div class="fixed"></div>
			<div class="content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><small><?php _e('Your comment is awaiting moderation.', 'linove'); ?></small></p>
				<?php endif; ?>

				<div id="commentbody-<?php comment_ID() ?>">
					<?php comment_text(); ?>
				</div>
			</div>
		</div>
		<div class="fixed"></div>

<?php
}
function pagination($query_string){   
global $posts_per_page, $paged;   
$my_query = new WP_Query($query_string ."&posts_per_page=-1");   
$total_posts = $my_query->post_count;   
if(empty($paged))$paged = 1;   
$prev = $paged - 1;   
$next = $paged + 1;   
$range = 2; // only edit this if you want to show more page-links   
$showitems = ($range * 2)+1;   
  
$pages = ceil($total_posts/$posts_per_page);   
if(1 != $pages){   
echo "<div class='pagination'>"; 
echo "<span class='inactive'>第 ".$paged." / ".$pages." 页</span>" ;
echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>最前</a>":"";   
echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>上一页</a>":"";   
  
for ($i=1; $i <= $pages; $i++){   
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){   
echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";   
}   
}   
  
echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>下一页</a>" :"";   
echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>最后</a>":"";   
echo "</div>\n";   
}   
}    
?>
