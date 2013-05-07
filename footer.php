	</div>
	<!-- main END -->

	<?php
		$options = get_option('linove_options');
		global $linove_nosidebar;
		if(!$options['nosidebar'] && !$linove_nosidebar) {
			get_sidebar();
		}
	?>
	<div class="fixed"></div>
</div>
<!-- content END -->

<!-- footer START -->
<div id="footer">
	<a id="gotop" href="#" onclick="MGJS.goTop();return false;"><?php _e('Top', 'linove'); ?></a>
	<a id="powered" href="http://wordpress.org/">WordPress</a>
	<div id="copyright">
		<?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'linove') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';

				echo $copyright;
				bloginfo('name');
			}
		?>
	</div>
	<div id="themeinfo">
		<?php printf(__('Theme create by <a href="%1$s">NeoEase</a>. modify by <a href="%4$s">LinJunlong</a> Valid <a href="%2$s">XHTML 1.1</a> and <a href="%3$s">CSS 3</a>.', 'linove'), 'http://www.neoease.com/', 'http://validator.w3.org/check?uri=referer', 'http://jigsaw.w3.org/css-validator/check/referer?profile=css3','http://linjunlong.com'); ?>
	</div>
</div>
<!-- footer END -->

</div>
<!-- container END -->
</div>
<!-- wrap END -->

<?php
	wp_footer();

	$options = get_option('linove_options');
	if ($options['analytics']) {
		echo($options['analytics_content']);
	}
?>

</body>
</html>

