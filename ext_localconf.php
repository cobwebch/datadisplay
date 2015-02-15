<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// Active save and new button

t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_datadisplay_displays=1
');

// Register as Data Consumer service
// Note that the subtype corresponds to the name of the database table

t3lib_extMgm::addService($_EXTKEY,  'dataconsumer' /* sv type */,  'tx_datadisplay_dataconsumer' /* sv key */,
		array(

			'title' => 'Data Display Engine',
			'description' => 'Generic Data Consumer for recordset-type data structures',

			'subtype' => 'tx_datadisplay_displays',

			'available' => TRUE,
			'priority' => 50,
			'quality' => 50,

			'os' => '',
			'exec' => '',

			'classFile' => t3lib_extMgm::extPath($_EXTKEY, 'class.tx_datadisplay.php'),
			'className' => 'tx_datadisplay',
		)
	);
?>