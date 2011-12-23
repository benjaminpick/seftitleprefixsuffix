<?php
//*******************************************************
//* SEF Title Prefix and Suffix Plugin
//* http://www.sefservicemap.com
//* (C) Radoslaw Kubera
//* license http://www.gnu.org/copyleft/gpl.html GNU/GPL
//*******************************************************


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin');
class plgSystemSeftitleprefixsuffix extends JPlugin
{
	function plgSystemSeftitleprefixsuffix(&$subject, $config)  {
		parent::__construct($subject, $config);
	}

	function onAfterDispatch() {
		$db = JFactory::getDBO();
		$query = "select id,params from #__plugins where element='seftitleprefixsuffix'";
		$db->setQuery($query);
		$plugin = $db->loadObject();
		$params = new JParameter($plugin->params);
		$suffix = $params->get('titlesuffix');
		$prefix = $params->get('titleprefix');
		$document =& JFactory::getDocument();
		$title = $document->getTitle();
		if ($prefix) {
			$title  = $prefix.$title;
		}

		if ($suffix) {
			$title.= $suffix;
		}
		$document->setTitle($title);

	}
}
