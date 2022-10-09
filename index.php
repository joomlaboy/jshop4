<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';


// Enable assets
$wa->useStyle('template.jshop4'.($this->direction == 'rtl' ? '.rtl' : ''))
	->useScript('template.bootstrap');

// Disable foobar from being attached
$wa->disableStyle('bootstrap.css');
#$wa->disableScript('jquery-noconflict');


// override wa
/*
$templatePath = 'templates/' . $this->template;
$wa->registerAndUseStyle('bootstrap', $templatePath . '/css/bootstrap.min.css');
$wa->registerAndUseStyle('jshop4', $templatePath . '/css/jshop4.css');
*/
$right = $this->countModules('right');
$left = $this->countModules('left');
$articleCol = "";
if($right !== true && $left == true){
	$articleCol="col-12 col-md-10";
}elseif($right == true && $left !== true){
	$articleCol="col-12 col-md-10";
}elseif($right == true && $left == true){
	$articleCol="col-12 col-md-8";
}else{
	$articleCol = "col-12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . Uri::root(true) . '/' . htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '">';
}
elseif ($this->params->get('siteTitle'))
{
	$logo = '<span title="' . $sitename . '">' . htmlspecialchars($this->params->get('siteTitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = HTMLHelper::_('image', 'logo.svg', $sitename, ['class' => 'logo d-inline-block'], true, 0);
}

// Container
$container = $this->params->get('fluidContainer') ? 'container-fluid' : 'container';

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');


?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>

<body class="site <?php echo $option
	. ' '
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($pageclass ? ' ' . $pageclass : '')
	. ($this->direction == 'rtl' ? ' rtl' : '');
?>">
	<header class="clearfix">
		
		<?php if ($this->countModules('topbar',true)) : ?>
		<div id="topbar" class="py-1 mb-2 clearfix">
			<div class="<?php echo $container; ?> clearfix">
				<div class="row">
				<jdoc:include type="modules" name="topbar" style="html5" />
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="<?php echo $container; ?> clearfix">
			<div class="row clearfix">

				<?php if ($this->params->get('brand', 1)) : ?>
				<div class="col-6 col-md-3 clearfix">
					<a class="brand-logo d-md-inline-block" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
					</a>
					<?php if ($this->params->get('siteDescription')) : ?>
						<span class="site-description h5 d-block d-md-inline-block"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></span>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<?php if ($this->countModules('header',true)) : ?>
				<jdoc:include type="modules" name="header" style="html5" />
				<?php endif; ?>

			</div>
		</div>
		

		<?php if ($this->countModules('menu', true)) : ?>
		<nav id="menu" class="<?php echo $container; ?> clearfix">
			<div class="row clearfix">
				<jdoc:include type="modules" name="menu" style="html5" />
			</div>
		</nav>
		<?php endif; ?>
	</header>


	<?php if ($this->countModules('banner', true)) : ?>
	<div id="banner" class="clearfix">
		<div class="<?php echo $container; ?> clearfix">
			<div class="row clearfix">
			<jdoc:include type="modules" name="banner" style="html5" />
			</div>
		</div>
	</div>
	<?php endif; ?>


	

	<?php if ($this->countModules('custom-a', true)) : ?>
	<div id="custom-a" class="<?php echo $container; ?> my-5 clearfix">
		<div class="row g-0 clearfix">
		<jdoc:include type="modules" name="custom-a" style="html5" />
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('custom-b', true)) : ?>
	<div id="custom-b" class="<?php echo $container; ?> my-5 clearfix">
		<div class="row g-0 clearfix">
		<jdoc:include type="modules" name="custom-b" style="html5" />
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('custom-c', true)) : ?>
	<div id="custom-c" class="<?php echo $container; ?> my-5 clearfix">
		<div class="row g-0 clearfix">
		<jdoc:include type="modules" name="custom-c" style="html5" />
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('custom-d', true)) : ?>
	<div id="custom-d" class="<?php echo $container; ?> my-5 clearfix">
		<div class="row g-0 clearfix">
		<jdoc:include type="modules" name="custom-d" style="html5" />
		</div>
	</div>
	<?php endif; ?>

	<main class="<?php echo $container; ?> clearfix">
		<div class="row clearfix">

			

			<?php if ($this->countModules('right', true)) : ?>
			<div id="right" class="col-12 col-md-2 clearfix">
				<jdoc:include type="modules" name="right" style="html5" />
			</div>
			<?php endif; ?>
			
			<article class="<?php echo $articleCol; ?> clearfix">
				<div class="row clearfix">

					<?php if ($this->countModules('main-top', true)) : ?>
					<div class="main-top">
						<jdoc:include type="modules" name="main-top" style="html5" />
					</div>
					<?php endif; ?>

					<jdoc:include type="message" />

					<div id="content" class="clearfix">
					<jdoc:include type="component" />
					</div>

					<?php if ($this->countModules('main-bottom', true)) : ?>
					<div class="main-bottom">
						<jdoc:include type="modules" name="main-bottom" style="html5" />
					</div>
					<?php endif; ?>

				</div>
			</article>
			
			<?php if ($this->countModules('left', true)) : ?>
			<div id="left" class="col-12 col-md-2 clearfix">
				<jdoc:include type="modules" name="left" style="html5" />
			</div>
			<?php endif; ?>

		</div>
	</main>
	
	<div id="bottom" class="<?php echo $container; ?> clearfix">

		

		<?php if ($this->countModules('bottom-a', true)) : ?>
		<div class="bottom-a">
			<jdoc:include type="modules" name="bottom-a" style="html5" />
		</div>
		<?php endif; ?>

		<?php if ($this->countModules('bottom-b', true)) : ?>
		<div class="grid-child container-bottom-b">
			<jdoc:include type="modules" name="bottom-b" style="html5" />
		</div>
		<?php endif; ?>

	</div>
	
	<?php if ($this->countModules('breadcrumbs', true)) : ?>
	<div id="breadcrumbs" class="clearfix">
		<div class="<?php echo $container; ?> clearfix">
			<div class="row clearfix">
			<jdoc:include type="modules" name="breadcrumbs" style="html5" />
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('footer', true)) : ?>
	<footer id="footer" class="clearfix">
		<div class="<?php echo $container; ?> clearfix">
			<div class="row clearfix">
			<jdoc:include type="modules" name="footer" style="html5" />
			</div>
		</div>

		<?php if ($this->countModules('copyright', true)) : ?>
		<div id="copyright" class="clearfix">
			<div class="<?php echo $container; ?> clearfix">
				<div class="row clearfix">
				<jdoc:include type="modules" name="copyright" style="html5" />
				</div>
			</div>
		</div>
		<?php endif; ?>

	</footer>
	<?php endif; ?>

	<?php if ($this->params->get('backTop') == 1) : ?>
		<a href="#top" id="back-top" class="back-to-top-link" aria-label="<?php echo Text::_('TPL_CASSIOPEIA_BACKTOTOP'); ?>">
			<span class="icon-arrow-up icon-fw" aria-hidden="true"></span>
		</a>
	<?php endif; ?>

	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
