<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<?php

$custom = JModuleHelper::getModule('mod_custom', 'Mattresses_new');

echo JModuleHelper::renderModule($custom, array('style'=>'blank'));

?>