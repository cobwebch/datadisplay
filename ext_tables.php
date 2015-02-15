<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// Define main TCA for table tx_dataquery_queries

t3lib_extMgm::allowTableOnStandardPages('tx_datadisplay_displays');

$TCA['tx_datadisplay_displays'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:datadisplay/locallang_db.xml:tx_datadisplay_displays',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icons/icon_tx_datadisplay_displays.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title, description, typoscript ',
	)
);

// Register datadisplay with the Display Controller as a Data Consumer

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['columns']['tx_displaycontroller_consumer']['config']['allowed'] .= ',tx_datadisplay_displays';

// Add a wizard for adding a datadisplay

$addDatadisplayWizard = array(
						'type' => 'script',
						'title' => 'LLL:EXT:datadisplay/locallang_db.xml:wizards.add_datadisplay',
						'script' => 'wizard_add.php',
						'icon' => 'EXT:datadisplay/res/icons/add_datadisplay_wizard.gif',
						'params' => array(
								'table' => 'tx_datadisplay_displays',
								'pid' => '###CURRENT_PID###',
								'setValue' => 'set'
							)
						);
$TCA['tt_content']['columns']['tx_displaycontroller_consumer']['config']['wizards']['add_datadisplay'] = $addDatadisplayWizard;

// Add static TypoScript

t3lib_extMgm::addStaticFile($_EXTKEY,'static/','Data display engine');
?>