<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Countdown CE'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Countdown CE');

t3lib_extMgm::addLLrefForTCAdescr('tx_jhecountdownce_domain_model_countdownce', 'EXT:jhe_countdownce/Resources/Private/Language/locallang_csh_tx_jhecountdownce_domain_model_countdownce.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_jhecountdownce_domain_model_countdownce');
$TCA['tx_jhecountdownce_domain_model_countdownce'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:jhe_countdownce/Resources/Private/Language/locallang_db.xml:tx_jhecountdownce_domain_model_countdownce',
		'label' => 'uid',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => '',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/CountdownCE.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jhecountdownce_domain_model_countdownce.gif'
	),
);

$extensionName = strtolower(t3lib_div::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('pi1');
$pluginSignature = $extensionName.'_'.$pluginName;
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/CountdownCE.xml');

?>