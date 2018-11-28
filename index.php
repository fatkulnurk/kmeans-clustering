<?php

//error_reporting(E_ERROR | E_PARSE);

include "dataset.php";

$k = 10;
$data = $data;

// print_r($data);
$n = count($data);
$dimensi = count($data['0']);

$newcentroid[$k][$dimensi] = array();

for($i=0;$i<$k;$i++){
    for ($j=0; $j<$dimensi;$j++){
        $newcentroid[$i][$j] = rand(10,200);
    }
}
echo "<hr>";
print_r($newcentroid);
echo "<hr>";

$jarak[$k]      = array();
$cluster[$n]    = array();

$nmember[$k]     = array();
$centroids[$k][$dimensi]  = array();
$selisih = 0;
$iterasi = 0;

//do{
    $iterasi++;

    for ($i = 0; $i < $k; $i++){
        for ($j=0;$j<$dimensi;$j++){
            $centroids[$i][$j] = $newcentroid[$i][$j];
            $newcentroid[$i][$j]=0;
        }
    }

    for ($i=0;$i<$k;$i++){
        $nmember[$i] = 0;
    }

    for ($i=0;$i<$n;$i++){
        $indexmin = -1;
        $nilaimin = 1000000;

        for ($i=0;$j<$k;$j++){
            $jarak[$j] = 0;
            for ($p=0;$p<$dimensi;$p++){
                $tempo = $data[$i][$p] - $centroids[$j][$p];
//                $jarak[$j] += pow($tempo,2);
                $jarak[$j] += $tempo * $tempo;
            }
            $jarak[$j] = sqrt($jarak[$j]);

            print_r($jarak);

            if ($jarak[$j] < $nilaimin){
                $indexmin = $j;
                $nilaimin = $jarak[$j];
            }
        }

        $cluster[$i] = $indexmin;

//        die(print_r($cluster));

//        $nmember[$cluster[$i]] += 1;
        if ( ! isset($nmember[$cluster[$i]])) {
            $nmember[$cluster[$i]] = null;
        }

        $nmember[$cluster[$i]] += 1;

        echo "<hr>";

//        die(print_r($nmember));

        for ($p=0;$p<$dimensi;$p++){
            $newcentroid[$cluster[$i]][$p] += $data[$i][$p];
        }

//        echo "<hr>";
        die(print_r($newcentroid));
    }

    $selisih = 0;

    for ($i = 0; $i<$k;$i++){
        for ($p=0;$p<$dimensi;$p++){
            $newcentroid[$i][$p] /= $nmember[$i];
            $selisih += abs($newcentroid[$i][$p] - $centroids[$i][$p]);
        }
    }
    die(print_r($newcentroid));

//}while($selisih > doubleval(0.0001));

for ($i=0;$i<$n;$i++){
    echo " ". $cluster[$i];
}
echo "<hr>";
echo "jumlah iterasi : ".$iterasi;
