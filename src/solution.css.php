<?php
header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: no-cache, must-revalidate");

// Okay, this might look like I'm cheating, but I promise I'm not!
// Basically, CSS is not capable of generating any form of "random" numbers.
// So I can just hardcode a solution in CSS, but then the game is only fun once.
// I thought that would be a bit lame.
// So this PHP snippet outputs some CSS with a unique solution in the form
// of some CSS variables.

// So the game is still 100% CSS :)

$solution = array_rand(range(0, 5), 4);
shuffle($solution);

echo ":root {";
foreach($solution as $index => $color)
	echo "--s$index: $color;";
echo "}";

?>
