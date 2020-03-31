<?php

$ime = $_POST['ime'] ?? '';
$prezime = $_POST['prezime'] ?? '';
$adresa = $_POST['adresa'] ?? '';
$broj_telefona = $_POST['broj_telefona'] ?? '';
$email = $_POST['email'] ?? '';
$marka = $_POST['marka'] ?? '';
$model = $_POST['model'] ?? '';
$datum_pocetka = $_POST['datum_pocetka'] ?? '';
$datum_kraja = $_POST['datum_kraja'] ?? '';
$broj_putnika = $_POST['broj_putnika'] ?? '';


$vrednosti = array();

array_push($vrednosti, $ime);
array_push($vrednosti, $prezime);
array_push($vrednosti, $adresa);
array_push($vrednosti, $broj_telefona);
array_push($vrednosti, $email);
array_push($vrednosti, $marka);
array_push($vrednosti, $model);
array_push($vrednosti, $datum_pocetka);
array_push($vrednosti, $datum_kraja);
array_push($vrednosti, $broj_putnika);

$vrednosti_postavljene = true;

foreach ($vrednosti as $vrednost) {
	if($vrednost == ''){
		$vrednosti_postavljene = false;
	}
}


if($vrednosti_postavljene == true){
	$rezervacije_fajl = fopen('rezervacije.json', 'r') or die('Greska!');

	if(filesize('rezervacije.json')>0){
		$sadrzaj = fread($rezervacije_fajl, filesize('rezervacije.json')-1);
	}else{
		$sadrzaj = "";
	}


	fclose($rezervacije_fajl);

	$rezervacije_fajl = fopen('rezervacije.json', 'w') or die('Greska!');

	if($sadrzaj == ''){
		$tekst = "[{
			\"ime\":\"$ime\",
			\"prezime\":\"$prezime\",
			\"adresa\":\"$adresa\",
			\"broj_telefona\":\"$broj_telefona\",
			\"email\":\"$email\",
			\"marka\":\"$marka\",
			\"model\":\"$model\",
			\"datum_pocetka\":\"$datum_pocetka\",
			\"datum_kraja\":\"$datum_kraja\",
			\"broj_putnika\":\"$broj_putnika\"

		}]";
	}else{
		$tekst = $sadrzaj . ",{
			\"ime\":\"$ime\",
			\"prezime\":\"$prezime\",
			\"adresa\":\"$adresa\",
			\"broj_telefona\":\"$broj_telefona\",
			\"email\":\"$email\",
			\"marka\":\"$marka\",
			\"model\":\"$model\",
			\"datum_pocetka\":\"$datum_pocetka\",
			\"datum_kraja\":\"$datum_kraja\",
			\"broj_putnika\":\"$broj_putnika\"

		}]";
	}

	file_put_contents('rezervacije.json', $tekst);

	fclose($rezervacije_fajl);
	
	echo "Rezervacija je uspešno poslata!";
	
}else{
    echo "Neuspešno slanje rezervacije. Pokušajte ponovo!";
}

?>