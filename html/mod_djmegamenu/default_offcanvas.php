<?php

/**

 * @package DJ-MegaMenu
 * @copyright Copyright (C) 2021 DJ-Extensions.com, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://dj-extensions.com
 * @author email contact@dj-extensions.com
 * @developer Szymon Woronowski, Artur Kaczmarek
 *
 * DJ-MegaMenu is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DJ-MegaMenu is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DJ-MegaMenu. If not, see <http://www.gnu.org/licenses/>.
 *
 */

defined('_JEXEC') or die;
?>
<div id="dj-megamenu<?php echo $module->id; ?>mobile" class="dj-megamenu-offcanvas <?php echo 'dj-megamenu-offcanvas-' . $params->get('mobiletheme') ; ?>">
	<?php require(JModuleHelper::getLayoutPath('mod_djmegamenu', 'default_btn')); ?>
	<aside id="dj-megamenu<?php echo $module->id; ?>offcanvas" class="dj-offcanvas <?php echo 'dj-fa-' . $params->get('fa') . ' ' . 'dj-offcanvas-' . $params->get('mobiletheme') . ' ' ; ?>" data-effect="<?php echo $params->get('offcanvas_effect') ?>" aria-hidden="true">
		<div class="dj-offcanvas-top">
			<a href="#" class="dj-offcanvas-close-btn" aria-label="<?php echo JText::_('MOD_DJMEGAMENU_CLOSE_MENU_BTN'); ?>"><span class="fa fa-close" aria-hidden="true"></span></a>
		</div>
		<?php if ($params->get('offcanvas_logo')) { ?>
			<div class="dj-offcanvas-logo">
				<a href="<?php echo JURI::base(); ?>">
					<img src="<?php echo $params->get('offcanvas_logo') ?>" alt="<?php echo $app->getCfg('sitename') ?>" />
				</a>
			</div>
		<?php } ?>
		<?php if (!empty($offmodules['top'])) { ?>
			<div class="dj-offcanvas-modules">
				<?php echo $offmodules['top'] ?>
			</div>
		<?php } ?>
		<div class="dj-offcanvas-content">
			<?php require(JModuleHelper::getLayoutPath('mod_djmegamenu', 'default_mobile')); ?>
		</div>
		<?php if (!empty($offmodules['bottom'])) { ?>
			<div class="dj-offcanvas-modules">
				<?php echo $offmodules['bottom'] ?>
			</div>
		<?php } ?>
	</aside>
</div>