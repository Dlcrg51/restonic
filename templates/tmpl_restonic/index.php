<?php
/**
 * @package     Joomla
 * @subpackage  Restonic2
 * 
 * @copyright   Copyright (c) 2012 - 2013
 * @license GNU General Public License Version 2 or Later
 */

// Getting params from template
$params = $this->params;

// Add Stylesheets
$this->addStyleSheet('templates/'.$this->template.'/css/template.css');

// get some template functionsg
require_once('templates/' .  $this->template . '/template_function.php');

// check to see if we are home
$page_type = tmpHelper::pageType();


$background_id = '';

if($params->get('background')) {
    $background_id = ' blog';
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

	<script type="text/javascript" charset="utf-8" src="<?php echo JUri::root(); ?>/media/jui/js/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo JUri::root(); ?>/templates/<?php echo $this->template; ?>/js/bootstrap-custom.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo JUri::root(); ?>/templates/<?php echo $this->template; ?>/js/bootstrap-tabcollapse.js"></script>
	<?php /* <script type="text/javascript" charset="utf-8" src="<?php echo JUri::root(); ?>/media/jui/js/jquery-noconflict.js"></script> */ ?>
	<script type="text/javascript" charset="utf-8" src="<?php echo JUri::root(); ?>/media/jui/js/html5.js"></script> 
<jdoc:include type="head" />
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-10432300-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>

<body class="<?php echo $page_type . $background_id ; ?><?php echo tmpHelper::getPageSuffix(); ?>">
	<header class="container">
		<section>
			<div class="logo">
				<a href="<?php echo JUri::root(); ?>">
					<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/<?php echo $params->get('logo', 'light'); ?>-logo.png" />
				</a>
			</div>
			<div class="search-social">
				<jdoc:include type="modules" name="search" style="none" />
				<div class="social">
					<jdoc:include type="modules" name="social-media" style="none" />
				</div>
			</div>
			<nav id="top-menu">
                <div class="navbar">
                    <div class="container">
                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#nav1">
                            <span class="nav-text">Site Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="nav-collapse collapse" id="nav1">
                            <jdoc:include type="modules" name="top-menu" style="none" />
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
			</nav>
		</section>
	</header>

	<?php if ($this->countModules('main-banner')): ?>
		<section class="main-banner">
			<div class="banner-slides">
				<ul class="slides">
					<jdoc:include type="modules" name="main-banner" style="slides" />
				</ul>
			</div>
		</section>
	<?php endif; ?>
	<?php if($page_type != 'home'): // only show mainbody on non-homepage ?>
		<section class="container">
			<div class="main-body-row">
				<?php if ($this->countModules('sidebar')): ?>
					<aside>
						<jdoc:include type="modules" name="sidebar" style="xhtml" />
					</aside>
					<div class="main-body-sidebar">
						<jdoc:include type="message" />
						<jdoc:include type="component" />
					</div>
				<?php else: ?>
					<div class="main-body">
						<jdoc:include type="message" />
						<jdoc:include type="component" />
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>


    <?php if ($this->countModules('below-content')): ?>
        <section id="below-content" class="container">
            <jdoc:include type="modules" name="below-content" style="xhtml" />
        </section>
    <?php endif; ?>

	<footer class="container">
        <?php if ($this->countModules('footer-menu')): ?>
            <section class="footer-row">
                <jdoc:include type="modules" name="footer-menu" style="xhtml" />
            </section>
        <?php endif; ?>
	</footer>

	<script type="text/javascript">
		jQuery().ready(function () {
			jQuery(".navbar-nav li a").each(function(n) {
				var $parent = jQuery(this).parent();
				if ($parent.hasClass('parent')) {
					jQuery(this).toggle(
						function() {
							$parent.addClass('open');
						}, function() {
							$parent.removeClass('open');
						}
					)
				};
			});
		});
	</script>

	<?php if ($page_type == 'home') : ?>
		<script type="text/javascript" charset="utf-8" src="<?php echo JUri::root(); ?>/templates/<?php echo $this->template; ?>/js/home.js"></script>
	<?php endif; ?>




    <script type="text/javascript" charset="utf-8" src="<?php echo JUri::root(); ?>/templates/<?php echo $this->template; ?>/js/ga-tracking.js"></script>


    <script language="JavaScript1.1" src="//pixel.mathtag.com/event/js?mt_id=511793&mt_adid=126670&v1=&v2=&v3=&s1=&s2=&s3="></script>
	</body>
</html>