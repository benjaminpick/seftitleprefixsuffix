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

	function onBeforeCompileHead() {
		$app = JFactory::getApplication();
		if(!$app->isSite()) 
			return;
			
		$params = $this->params;
		$suffix = $params->get('titlesuffix');
		$prefix = $params->get('titleprefix');
		$spacer = $params->get('spacer');
		$showifequal = $params->get('showifequal', 'no') == 'yes';
		
		$spacer .= ' '; // un-trim
		$document =& JFactory::getDocument();
		$title = $document->getTitle();
		if ($prefix) {
			if ($showifequal || $prefix != $title)	
				$title  = $prefix . $spacer . $title;
		}

		if ($suffix && $suffix != $title) {
			if ($showifequal || $suffix != $title)	
				$title.= $spacer . $suffix;
		}
		$document->setTitle($title);
	}
}
