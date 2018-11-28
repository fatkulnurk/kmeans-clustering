<?php
declare(strict_types=1); 

$file = fopen("C:\\xampp\htdocs\ml\clustering\kmeans\data\datasetruspini.txt","rb");
//$test = fopen("D:\kuliah\ML\atugas\datatesruspini.txt","rb");
$i    = 0;
$j	  = 0; 

$status = 0;
$baris  = 1;
				
while(!feof($file)){
	$line[$baris] = fgets($file);
	$baris++;				
}			
$jbaris = count($line);
	for ($i=0; $i < $jbaris; $i++) { 
	$sample[$i] = explode(',', $line[$i+1]);
}
			
$jml_pisah_baris  = count($sample);
$jml_pisah_kolom  = count($sample[1]);	
			
for ($a=0; $a <$jml_pisah_baris ; $a++) { 
	for ($b=0; $b < $jml_pisah_kolom-1; $b++) { 
		$data[$a][$b] = $sample[$a][$b];
	}
}
	
for ($a=0; $a <$jml_pisah_baris ; $a++) { 
	$label[$a] = $sample[$a][2];
}

fclose($file);

 print_r($data);
//echo json_encode($sample);
echo "<hr>";
echo "Jumlah data: ".count($data);