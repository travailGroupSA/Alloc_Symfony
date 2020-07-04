<?php
trait GenereMatricule{
 public function generateMat($nom,$prenom){
    $annee = date('Y');
    // echo $annee;
    $aleat=rand();
    $aleat=substr($aleat,0,4);
    //deux premierr lettres du nom
    $twoFirstLetters = strtoupper(substr($nom,0,2));
    //deux derniers lettres du prenom
    $twoLastLetters =  strtoupper(substr($prenom,-2));

    return $matricule = $annee.$twoFirstLetters.$twoLastLetters.$aleat;
}
}