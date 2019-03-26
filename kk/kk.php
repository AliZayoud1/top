<?php
if (isset($_POST['submit'])) {
	$number = $_POST['kk'];
	$total= 0;
	$i = 1;

	$last4 = substr($number, -4,4);
	$number = str_split($number);
	$number = array_reverse($number);

	foreach ($number as $digit) {
		if ($i % 2 == 0) {
			$digit *= 2;
			if ($digit >9) {
				$digit -=9;
			}
		}
		$total += $digit;
		$i++;
	}
	if ($total % 10 == 0) {
		echo "Toto konciace cislo tvojej karty " .$last4. 
		" je platne";
	}else {
		echo "Toto konciace cislo tvojej karty " .$last4. 
		" nieje platne";
	}

}
?>