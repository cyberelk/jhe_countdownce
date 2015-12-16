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
	 * countdownCERepository
	 *
	 * @var Tx_JheCountdownce_Domain_Repository_CountdownCERepository
	 */
	protected $countdownCERepository;

	/**
	 * injectCountdownCERepository
	 *
	 * @param Tx_JheCountdownce_Domain_Repository_CountdownCERepository $countdownCERepository
	 * @return void
	 */
	public function injectCountdownCERepository(Tx_JheCountdownce_Domain_Repository_CountdownCERepository $countdownCERepository) {
		$this->countdownCERepository = $countdownCERepository;
	}

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
			$todayDateTime = new DateTime(date('Y-m-d H:i:s', time()));
			$targetDateTime = new DateTime(date('Y-m-d H:i:s', $this->settings['targetdatetime']));
			$interval = $todayDateTime->diff($targetDateTime);
			$this->settings['timeToTargetDate'] = array(
				'days' => $interval->format('%a'),
				'hours' => $interval->format('%h'),
				'minutes' => $interval->format('%i'),
				'seconds' => $interval->format('%s')
			);
		}

		$this->view->assign(settings, $this->settings);
	}

}
?>