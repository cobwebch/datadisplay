<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_datadisplay_displays'] = array(
	'ctrl' => $TCA['tx_datadisplay_displays']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,title,description,typoscript'
	),
	'feInterface' => $TCA['tx_datadisplay_displays']['feInterface'],
	'columns' => array(
		't3ver_label' => array(
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:datadisplay/locallang_db.xml:tx_datadisplay_displays.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			)
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:datadisplay/locallang_db.xml:tx_datadisplay_displays.description',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '4',
			)
		),
		'typoscript' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:datadisplay/locallang_db.xml:tx_datadisplay_displays.typoscript',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '4',
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2, description, typoscript;;;;3-3-3')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
?>