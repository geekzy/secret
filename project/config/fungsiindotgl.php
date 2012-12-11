<?php
function tglindo ($tgl){
	$tanggal = substr($tgl, 8,2);
	$bulan = get_bulan (substr($tgl, 5,2));
	$tahun =  substr($tgl, 0,4);
	return $tanggal.''.$bulan.''.$tahun;

}

function get_bulan($bulan){
	switch ($bulan) {
		case '1' :
			return "januari";
					# code...
					break;
		case '2':
			return "februari";
					# code...
					break;
		case '3':
			return "maret";
					# code...
					break;
		case '4':
			return "april";
					# code...
					break;
		case '5':
			return "mei";
					# code...
					break;
		case '6':
			return "juni";
					# code...
					break;	
		case '7':
			return "juli";
					# code...
					break;
		case '8':
			return "agustus";
					# code...
					break;
		case '9':
			return "september";
					# code...
					break;	
		case '10':
			return "oktober";
					# code...
					break;	
		case '11':
			return "november";
					# code...
					break;															
		case '12':
			return "desember";
					# code...
					break;				
		
	}
}
?>