<?php
for ($hora = 0; $hora <= 24; $hora++) {
	for ($min = 0; $min <= 60; $min++) {
		if ($hora >= 5) {
			echo "Son las $hora PM y $min minutos \n";
		} else {
			echo "Son las $hora AM y $min minutos \n";
		}
	}
}
?>