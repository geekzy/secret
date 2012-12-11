<?
	//::::: MENCARI NAMA PENYAKIT :::::\\
	echo "<div align='center'><h3>HASIL PERHITUNGAN</h3></div>";
	$kdp 	= explode("-",$dr_penyakit2);
	$nomor	= 1;
	while(!$kdp[$nomor] == "")
	{
		$q = "SELECT nama_penyakit from penyakit WHERE kode_penyakit='$kdp[$nomor]'";
		//::::: MENCARI KEPASTIAN PAKAR :::::\\
		$data = mysql_fetch_row(mysql_query($q));
		$qkepastian = mysql_query("	SELECT a.prob, b.probabilitas FROM gejalapenyakit a, gejala b 
									WHERE b.kode_gejala=a.kd_gejala AND a.kd_penyakit='$kdp[$nomor]'");
		$totalprop1 = 0;
		$totalprop2 = 0;
		while($kepastian = mysql_fetch_row($qkepastian)){
			$totalprop1 = $totalprop1 + ($kepastian[0]*$kepastian[1]);
			$totalprop2 = $totalprop2 + $kepastian[0];
		}
		$kepastianpakar = round($totalprop1/$totalprop2,2);
		$daftargejala   = str_replace("-",", ",$dr_gejala2);
		echo "<table width='550' border='0'>
				<tr><td width='100'>Nama Penyakit</td><td> : <font color='#2EA230'>$data[0]</font></td></tr>
				<tr><td width='100'>Kepastian Pakar</td><td> : $kepastianpakar</td></tr>
			</table>";
		echo "<table width='550' class='isi'><tr><td>";
		//::::: MENCARI BAYES :::::\\
		$gjl 	= explode("-",$dr_gejala2);
		$prb 	= explode("-",$dr_prob2);
		$i		= 0;
		$n		= 0;
		$k		= 0;
		$nilai1 = 0;
		$nilai2 = 0;
		$totalnilai=0;
		while(!$gjl[$i] == ""){
			$n++;
			if($n <= 1){
				$nilai1 = $prb[$i];
			}else if($n <= 2){
				$k++;
				$nilai2 = $prb[$i];
				echo "Perhitungan ke $k :<br>";
				echo "Nilai 1 = $nilai1<br>";
				echo "Nilai 2 = $nilai2<br><br>";
				$total = $nilai1*$nilai2;
				$totalnilai = $totalnilai+$total;
				$bayes = round($total/$kepastianpakar,2);
				echo "Total = $total<br>Bayes = $bayes<br><hr width='150' align='left'>";
				$n=0;
			}
			$i++;
		}
		$totalbayes = round(($totalnilai/$kepastianpakar),2);
		echo "Perhitungan Total :<br>";
		echo "Total Nilai = $totalnilai<br>Total Bayes = $totalbayes";
		echo "</td></tr></table>";
		echo "<hr>";
		$nomor++;
	}
?>