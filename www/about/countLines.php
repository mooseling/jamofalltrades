<?php
function searchDir($dirName, $fileArr) {
	$dirArray = scandir($dirName);

	foreach ($dirArray as $key => $value) {
		if(!in_array($value, array(".",".."))) {
			switch (filetype($dirName."/".$value)) {
				case "file":
					$fileArr[] = $dirName."/".$value;
					break;
				case "dir":
					$fileArr = searchDir($dirName."/".$value, $fileArr);
					break;
			}
		}
	}

	return $fileArr;
}

$fileArray = array();
chdir("..");
$fileArray = searchDir(".",$fileArray);

$lineArray = array("php" => 0, "html" => 0, "css" => 0, "js" => 0);

foreach ($fileArray as $value) {
	switch (pathinfo($value,PATHINFO_EXTENSION)){
		case "css":
		case "js":
		case "html":
		case "php":
			$f = fopen($value, "r");
			while(fgets($f)){
				$lineArray[pathinfo($value,PATHINFO_EXTENSION)]++;
			}
			fclose($f);
			break;
		default:
			$lineArray[pathinfo($value,PATHINFO_EXTENSION)]++;
			break;
		/*
		case "html":
		case "php":
			$f = fopen($value, "r");
			while($line = fgets($f)){
				$lineArray["html"]++;
				preg_match_all("/<script>.+?<\/script>/x", $line, $jsSnippets);
				$lineArray["js"] += count($jsSnippets[0]);
				preg_match_all("/<style>.+?<\/style>/x", $line, $cssSnippets);
				$lineArray["css"] += count($cssSnippets[0]);
			}
			fclose($f);
			break;
		case "php":
			$f = fopen($value, "r");
			while($line = fgets($f)){
				//if($line == "<?php" or $line == "<?"){
				if(preg_match('/^\s*<\?/', $line)){
					$lineArray["php"]++;
					do {
						$line = fgets($f);
						$lineArray["php"]++;
					} while (!preg_match('^\s*<\?', $line));
				} else {
					$lineArray["html"]++;//Not true? Could have been php inside a css block?
					if (preg_match('/^\s*<script>/', $line)){
						$line = fgets($f);
						//guuuuuuuuuuh
					}
				}
			}
			fclose($f);
			break;
		*/
	}
}
?>

This site was built from <?php echo $lineArray["php"]; ?> lines of php, <?php echo $lineArray["html"]; ?> lines of html, <?php echo $lineArray["css"]; ?> lines of css, and <?php echo $lineArray["js"]; ?> lines of javascript. There are also <?php
$i = 0;
foreach ($lineArray as $key => $value) {
	$i++;
	if (!in_array($key, array("php","css","html","js"))){
		echo $value." ".$key." file";
		if($value > 1){ echo "s";}
		if($i == count($lineArray)){
			echo ".";
		}
		else{
			if(count($lineArray) > 6)
			echo ", ";
			if($i == count($lineArray) - 1){
				echo "and ";
			}
		}
	}
} ?>