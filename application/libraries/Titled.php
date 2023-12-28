<?php
	class titled{
		public function gen_litle_title($umur, $jkel, $status) {
			$title = "";
			if ($umur < 10) {
				$title = "An";
			} else if ($umur > 10) {
				if ($jkel == "L") {
					if ($status == "BK" && $umur < 30) {
						$title = "Sdr";
					} else {
						$title = "Tn";
					}
				} else {
					if ($status == "BK" && $umur < 30) {
						$title = "Nn";
					} else {
						$title = "Ny";
					}
				}
			}

			return $title;
		}
	}