<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// Add static TypoScript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'ad: Google Maps API');

?>