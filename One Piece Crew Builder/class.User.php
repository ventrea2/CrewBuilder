<?php

class User{
	private $crewid;
	private $name;
	private $database;
	
	function __construct($crewid, $database){
		$sql = file_get_contents('sql/getUser.sql');
		$params = array(
			'crewid' => $crewid
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$user = $statement->fetchAll(PDO::FETCH_ASSOC);
		$userInfo = $user[0];
		$this->crewid = $userInfo['crewid'];
		$this->name = $userInfo['name'];
	}
	
	function get($key){
		return $this->$key;
	}
}
?>
