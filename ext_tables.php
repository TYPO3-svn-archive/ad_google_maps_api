<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// Class used for constants.
#include_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Domain/Model/Map.php');
#include_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Domain/Model/Layer.php');

// Add static TypoScript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'ad: Google Maps API');

?>