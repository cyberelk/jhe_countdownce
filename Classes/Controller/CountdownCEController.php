<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Jari-Hermann Ernst <jari-hermann.ernst@bad-gmbh.de>, B·A·D GmbH
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package jhe_countdownce
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_JheCountdownce_Controller_CountdownCEController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action index
	 *
	 * @return void
	 */
	public function indexAction() {

		if($this->settings['countTo'] == 'date') {
			$todayDate = new DateTime(date('Y-m-d', time()));
			$targetDate = new DateTime(date('Y-m-d', $this->settings['targetdate']));
			$interval = $todayDate->diff($targetDate);
			$this->settings['daysToTargetDate'] = $interval->format('%a');
		} else if($this->settings['countTo'] == 'datetime'){

			//integrate jquery.countdown and other necessary modules
			$GLOBALS['TSFE']->additionalHeaderData['tx_jhecountdownce'] = '
				<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/jquery.countdown.min.js"></script>
				<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/moment-with-locales.js"></script>
				<script type="text/javascript" src="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/JavaScript/lodash.js"></script>
				<link rel="stylesheet" type="text/css" href="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/Css/jhe_countdownce.css" media="all">
			';

			/*
			 *  little hack to get around the problem of loosing or adding an hour while changing from or to daylight saving time,
			 * which is mathematically correct but annoying for humans to read by adding od subtracting one hour
			 */
			if(date('c') == date('c', $this->settings['targetdatetime'])){
				$this->settings['targetDateString'] = date('c', $this->settings['targetdatetime']);
			} else {
				if(date('c') < $this->settings['targetdatetime']){
					$this->settings['targetDateString'] = date('c', $this->settings['targetdatetime'] + 3600);
				} else if(date('c') > $this->settings['targetdatetime']) {
					$this->settings['targetDateString'] = date('c', $this->settings['targetdatetime'] - 3600);
				}
			}
		}

		$this->view->assign(settings, $this->settings);
	}

}
?>