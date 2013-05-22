		<!-- header START -->
		<div id="header">
			<!-- banner START -->
			<?php
		if ($options['banner_content'] && (($options['banner_registered'] && $user_ID) || ($options['banner_commentator'] && !$user_ID && isset ($_COOKIE['comment_author_' . COOKIEHASH])) || ($options['banner_visitor'] && !$user_ID && !isset ($_COOKIE['comment_author_' . COOKIEHASH]))))
			:
		?>
				<div class="banner">
					<?php echo($options['banner_content']); ?>
				</div>
			<?php endif; ?>
			<!-- banner END -->
		
			<div id="caption">
				<h1 id="title"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>
				<div id="tagline"><?php bloginfo('description'); ?></div>
			</div>
		
			<div class="fixed"></div>
		</div>
		<!-- header END -->
		
		<!-- navigation START -->
		<div id="navigation">
			<!-- menus START -->
			<ul id="menus">
				<li class="<?php echo($home_menu); ?>"><a class="home" title="<?php _e('Home', 'linove'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'linove'); ?></a></li>
				<?php
		 if ($options['menu_type'] == 'categories') {
				wp_list_categories('title_li=0&orderby=name&show_count=0');
			} else {
				wp_list_pages('title_li=0&sort_column=menu_order');
			}
		?>
				<li><a class="lastmenu" href="javascript:void(0);"></a></li>
			</ul>
			<!-- menus END -->
		
			<!-- searchbox START -->
			<div id="searchbox">
				<?php if($options['google_cse'] && $options['google_cse_cx']) : ?>
					<form action="http://www.google.com/cse" method="get">
						<div class="content">
							<input type="text" id="search_textfield" class="textfield" name="q" size="24" />
							<input type="submit" id="search_button" class="button" name="sa" value="" />
							<input type="hidden" name="cx" value="<?php echo $options['google_cse_cx']; ?>" />
							<input type="hidden" name="ie" value="UTF-8" />
						</div>
					</form>
				<?php else : ?>
					<form action="<?php bloginfo('home'); ?>" method="get">
						<div class="content">
							<input type="text" id="search_textfield" class="textfield" name="s" size="24" value="<?php echo wp_specialchars($s, 1); ?>" />
							<input type="submit" id="search_button" class="button" value="" />
						</div>
					</form>
				<?php endif; ?>
			</div>
			<!-- searchbox END -->
			<div class="fixed"></div>
		</div>
		<!-- navigation END -->
