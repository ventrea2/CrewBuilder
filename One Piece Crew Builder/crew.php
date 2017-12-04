<?php
include('config.php');

$crewid = $user->get('crewid');
$isCap = isCap($crewid, $database);
if($isCap == false)
{
	header ("location: class.php");
}


$sql = file_get_contents("sql/getCrew.sql");
$statement = $database->prepare($sql);
$statement->execute();
$crew = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Crew Members</title>
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
			<li><a href="logout.php">Logout</a></li>
	</ul>
	</nav>
	<div class="page">
	<img id="jolly" src="images/jolly.png" alt="jolly">
	<h1> Crew Members </h1>
		<p>Crew members are created by all accounts and can be added to your crew.<br />
		<a href="crewForm.php?action=add"> Create a Crew member</a></p>
		<?php foreach ($crew as $cm) : ?>
			<hr>
			<br />
			<p>
				<strong><?php echo $cm['name']; ?></strong><br />
				<img id="beli" src="images/Beli.png" alt="beli"><?php echo $cm['bounty']; ?> <br />
				<?php echo $cm['abilities']; ?> <br />
				<?php echo $cm['Info']; ?> <br />
				<a href="crewForm.php?action=edit&crewid=<?php echo $cm['crewid'] ?>">Edit Crew Member</a>
			</p>
			<br />
		<?php endforeach; ?>
	</div>
</body>
</html>