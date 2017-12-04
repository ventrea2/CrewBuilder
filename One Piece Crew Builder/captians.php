<?php
include('config.php');

$crewid = $user->get('crewid');
$isCap = isCap($crewid, $database);
if($isCap == false)
{
	header ("location: class.php");
}



$sql = file_get_contents("sql/getCaptains.sql");
$statement = $database->prepare($sql);
$statement->execute();
$captain = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Captains</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<nav>
	<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="captians.php">Captains</a></li>
			<li><a href="crew.php">Crew Members</a></li>
			<li><a href="buildCrew.php?action=add&crewid=<?php echo $crewid ?>">Build Crew</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="logout.php">Logout</a>
	</ul>
	</nav>
	<div class="page">
	<img id="jolly" src="images/jolly.png" alt="jolly">
	<h1> Captians </h1>
	<p>Only one Captain per account. You may View other accounts Captains, but you may only edit yours.<br />
	<a href="captianForm.php?action=edit&crewid=<?php echo $crewid ?>">Edit Your Captain</a></p>
		<?php foreach ($captain as $cap) : ?>
			<hr>
			<br />
			<p>
				<strong><?php echo $cap['name']; ?></strong><br />
				<img id="beli" src="images/Beli.png" alt="beli"><?php echo $cap['bounty']; ?> <br />
				<?php echo $cap['crewName']; ?> <br />
				<?php echo $cap['abilities']; ?> <br />
				<?php echo $cap['Info']; ?> <br />
			</p>
			<br />
		<?php endforeach; ?>
	</div>
</body>
</html>