<?php

function isCap($crewid, $database) {
	$sql = file_get_contents("sql/checkCaptain.sql");
	$params = array(
		'crewid' => $crewid
	);	
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$captain = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$check = $captain[0];

	if	($crewid == $check['crewid'])
	{
		return true;
	}
	else
	{
		return false;
	}
}

/*function searchCrews($term, $database) {
	$term = $term . '%';
	$sql = file_get_contents('sql/searchCrews.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$crews = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $crews;
}

function searchCaptains($term, $database) {
	$term = $term . '%';
	$sql = file_get_contents('sql/searchCaptains.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$captains = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $captains;
}
*/
function get($key) {
	if(isset($_GET[$key]))
		return $_GET[$key];
	else
		return '';
}

?>