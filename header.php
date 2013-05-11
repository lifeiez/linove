<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
	global $linove_nosidebar;
	$options = get_option('linove_options');
	if (is_home()) {
		$home_menu = 'current_page_item';
	} else {
		$home_menu = 'page_item';
	}
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<?php include('includes/seo.php'); ?>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'linove'); ?>" href="<?php echo $feed; ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all comments', 'linove'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!-- style START -->
	<!-- default style -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.1.0.3.css" type="text/css" media="screen" />
	<!-- for translations -->
	<?php if (strtoupper(get_locale()) == 'ZH_CN' || strtoupper(get_locale()) == 'ZH_TW') : ?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/chinese.1.0.2.css" type="text/css" media="screen" />
	<?php elseif (strtoupper(get_locale()) == 'HE_IL' || strtoupper(get_locale()) == 'FA_IR' || strtoupper(get_locale()) == 'UG_CN' || strtoupper(get_locale()) == 'CKB') : ?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/rtl.1.0.2.css" type="text/css" media="screen" />
	<?php endif; ?>
	<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie.1.0.2.css" type="text/css" media="screen" />
	<![endif]-->
	<!-- style END -->
	<?php wp_head(); ?>
</head>

<?php flush(); ?>

<body>
<!-- wrap START -->
<div id="wrap">

<!-- container START -->
<div id="container" <?php if($options['nosidebar'] || $linove_nosidebar){echo 'class="one-column"';} ?> >

<?php include('templates/header.php'); ?>

<!-- content START -->
<div id="content">

	<!-- main START -->
	<div id="main">
