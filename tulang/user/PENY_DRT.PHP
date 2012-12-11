<body>
<p>Gejala yang telah dipilih:</p>
<div align="left">
<ul>
<?
$g = explode("-",$gejala);
$p = explode ("-",$drt_prob);
$n=0;
while (!$g[$n]==""){
	$qgejala = mysql_query("SELECT nama_gejala FROM gejala WHERE kode_gejala='$g[$n]'");
	$dgejala = mysql_fetch_row($qgejala);
	echo "<li>($p[$n]) :: $dgejala[0]</li>";
$n++;}
?>
</ul>
</div>
<?
$p=explode("-",$drt_penyakit);
$m=1;
while (!$p[$m]==""){
	if($wp=="") $wp = " kode_penyakit='".$p[$m]."'";
	else $wp .= " OR kode_penyakit='".$p[$m]."'";
$m++;}
$querypenyakit=mysql_query("SELECT * FROM penyakit WHERE ".$wp);
?>
<br>
<p>Terdapat <? echo $m-1; ?> penyakit yang terdeteksi:</p>
<div align="left">
<ul>
  <?
  while($data=mysql_fetch_row($querypenyakit)){
  	$string=explode(" ",$data[2]);
	$penggalan="";
	for($i=0;$i<20;$i++) $penggalan=$penggalan." ".$string[$i];
	if (!$string[$i]=="") $penggalan=$penggalan."....";
  	echo "<li><font color='#2EA230'>$data[1]</font> :: $penggalan</li>";
  }	
  ?>
</ul>
</div>
</body>
