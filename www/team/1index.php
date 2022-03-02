<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	$departments = array("Board of Trustees","Hong Kong Office","Brand Management","Unpaid Interns","Research Team","Analytics Team","Construction Team","Whale Preservation Team","Finance and Philology","Project Officers","Pidgeon Specialists","Bar Staff","Junior Management","Education Team","Council of Elders","Very Senior Management");
	shuffle($departments);
	$colorSchemes = array(array("8DFAFF","AAFBFF","C1FCFF","C7D7FF","99B6FF","C0FFC4","A9FFAF","8DFF94"),array("F7BBA2","FBCDBA","FBDACB","F7D3A2","FBE0BA","FBE7CB"),array("FFFD99","FFFEB2","FFFEC7","DDFB96","E6FDB1","ECFDC5","FFF1B2","FFEC99"),array("B5F693","C9FAAF","D6FAC3","8AE6CA","AAF3DD","BDF3E2","ECFDB1","E5FC97","F1FDC6"),array("F9AED4","F9C2DE","FFB8B2","FFCBC7","E3C0F3","DEADF3"));
	shuffle($colorSchemes[0]);
	shuffle($colorSchemes[1]);
	shuffle($colorSchemes[2]);
	shuffle($colorSchemes[3]);
	shuffle($colorSchemes[4]);
	shuffle($colorSchemes);
	$pHArray = array(
		"21" => "insanely acidic",
		"22" => "catastrophically acidic",
		"23" => "embarassingly acidic",
		"24" => "too acidic",
		"25" => "a bit too acidic",
		"26" => "a bit acidic",
		"27" => "slightly acidic",
		"28" => "nicely ballanced",
		"29" => "slightly basic",
		"30" => "a bit basic",
		"31" => "pretty basic",
		"32" => "way too basic",
		"33" => "embarassingly basic",
		"34" => "catastrophically basic",
		"35" => "insanely basic"
	);
?>
<html>
<head>
	<title>The Team</title>
	<?php include '../header.html'; ?>
	<link id=teamStyle rel=stylesheet type=text/css href=style.css>
</head>
<body>
	<?php include '../navbar.php'; ?>
	<?php
	$con = (function() {
		include '../../includes/db-credentials.php';
		return mysqli_connect('localhost', $dbUsername, $dbPassword, $dbName);
	})();
	mysqli_query($con, 'SET NAMES UTF8');
	$employeesResult = mysqli_query($con,'SELECT * FROM Employees WHERE Ready = 1');
	if (mysqli_num_rows($employeesResult) > 0) {
		$employeesArray = array();
		$genderSum = 0;
	    while($row = mysqli_fetch_assoc($employeesResult)){
        	$employeesArray[] = $row;
        	$genderSum += $row['Male'];
	    }
	    $genderPH = log((count($employeesArray)-$genderSum)/$genderSum,10) + 7;//(1-$genderSum/count($employeesArray))*14;
			shuffle($employeesArray);
	    ?>
	<div class=listWrapper>
		<div id=topText>
			<p>Meet our award winning team below. Without them, none of them would be here.</p>
		</div>
				<div id=seniorManagement class=departmentWrapper>
			<h1><?php echo $departments[0]; ?></h1>
			<?php
			    $i = 1; // member counter
			    $j = 0; // department member counter
			    $k = 1; // department counter
			    foreach ($employeesArray as $person) {
			?>
			<div id="memberWrapper<?php echo $i ?>" class=memberWrapper style="background-color:<?php echo '#'.$colorSchemes[$k % count($colorSchemes)][$j % count($colorSchemes[$k%count($colorSchemes)])] ?>">
				<div class=imgWrapper>
					<a href="<?= $person["LinkURL"];?>">
						<img src="/team/pictures/<?= $person["ImageURL"];?>">
					</a>
				</div>
				<div class=blurbWrapper>
					<a href="<?php echo $person["LinkURL"]; ?>" target=_blank><span class=name><?php echo $person["Name"]; ?></span></a><br>
					<span class=jobTitle><?php echo $person["Role"]; ?></span><br>
					<span class=blurb><?php echo $person["Blurb"]; ?></span>
				</div>
			</div>
			<?php
					$j++;
					if ($i<sizeof($employeesArray) && (($j==1 && mt_rand(1,10)>8) || ($j==2 && mt_rand(1,10)>4) || ($j>2 && mt_rand(1,10)>3))){
			?>
			</div>
			<div class=departmentWrapper>
				<h1><?php echo $departments[$k % count($departments)]; ?></h1>
			<?php
						$j = 0;
						$k++;
					}
					$i++;
				} // end loop
			?>
			<?php
				} else {
				    echo "The Database is down! Therefore, no one works here anymore.";//Need to echo a new body
				}
			?>
		<div>
	</div>

	<p id=gender-ph>Current gender pH: <?php echo number_format($genderPH,2); ?> ...That's <?php echo $pHArray[number_format($genderPH*4,0)]; ?>.<br>
</body>
</html>
