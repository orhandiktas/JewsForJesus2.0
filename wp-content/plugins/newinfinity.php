<?php
echo 'hello world';
require_once("infinity.php");
// Build the filter values
	$filterCount = 0;
	$filterValues=array();

	$filterValues[$filterCount] = getStringFilter('POSTCODESTEM', '945');
	$filterCount++;

	$soapClient = new
		infinitySOAP();
		
	$result = getDataListValues($soapClient, '7685f717-acaa-49ca-af6a-3b5071cf3799', $filterValues);

	var_dump($result);
?>