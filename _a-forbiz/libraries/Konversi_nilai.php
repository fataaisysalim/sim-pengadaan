<?php 
/**
* 
*/
class CI_Konversi_nilai
{
	public function terbilang($x) {
		$angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		
		if ($x < 12) {
			return " " . $angka[$x];
		}
		elseif ($x < 20) {
			$x = substr($x, 1);
			return $angka[$x] . " belas";
		}elseif ($x < 100) {
			$z = substr($x, 1) == 0 ? null : $angka[substr($x, 1)];
			$y = $angka[substr($x, 0, 1)];
			return $y . " puluh " . $z;
		}
		elseif ($x == 100) {
			return "seratus";
		}
	}	
}
?>