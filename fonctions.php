<?php

function connexion()
{
    $serveur = "localhost";
    $login = "root";
    $password = "root";
    $bdd = "gsb2016";
    $connect = mysql_connect($serveur, $login, $password);
    $connectdb = mysql_select_db($bdd, $connect);
    return $connect;
}

function VerifCompte($num)
{
    $connect = connexion();
    $sql = "SELECT *
        FROM visiteur
        WHERE id = '$num'";
    $req = mysql_query($sql);
    $ligne = mysql_num_rows($req);
    if($ligne != 0)
    {
        $return = true;
    }
    else
    {
        $return = false;
    }
    return $return;
}

function VerifFiche($num, $date)
{
    $connect = connexion();
    $sql = "SELECT *
        FROM fichefrais
        WHERE idVisiteur = '$num' and mois = '$date'";
    $req = mysql_query($sql);
    $ligne = mysql_num_rows($req);
    if($ligne != 0)
    {
        $return = false;
    }
    else
    {
        $return = true;
    }
    return $return;
}

function InsertFiche($num, $date, $midi, $nuitee, $etape, $km)
{
    $connect = connexion();
    $sql = "SELECT montant
        FROM fraisforfait
        WHERE id = 'ETP';";
    $req = mysql_query($sql);
    $ETP = mysql_fetch_row($req);
    
    $sql2 = "SELECT montant
        FROM fraisforfait
        WHERE id = 'KM';";
    $req2 = mysql_query($sql2);
    $KM = mysql_fetch_row($req2); 
    
    $sql3 = "SELECT montant
        FROM fraisforfait
        WHERE id = 'NUI';";
    $req3 = mysql_query($sql3);
    $NUI = mysql_fetch_row($req3);
    
    $sql4 = "SELECT montant
        FROM fraisforfait
        WHERE id = 'REP';";
    $req4 = mysql_query($sql4);
    $REP = mysql_fetch_row($req4);
    
    $montantETP = $ETP[0] * $etape;
    $montantKM = $KM[0] * $km;
    $montantNUI = $NUI[0] * $nuitee;
    $montantREP = $REP[0] * $midi;
    $sql3 = "INSERT INTO fichefrais (datemodif, idEtat, idVisiteur, mois, montantValide, nbJustificatifs)
        VALUES (NOW(), 'CL', '$num', '$date', '$montantETP + $montantKM + $montantNUI + $montantREP', '$midi + $nuitee + $etape + $km');";
    mysql_query($sql3);
    
}

function InsertLigneFrais($num, $date, $midi, $nuitee, $etape, $km)
{
    $connect = connexion();
    $sql4 = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite)
        VALUES ('$num', '$date', 'ETP', '$etape');";
    mysql_query($sql4);
    $sql5 = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite)
        VALUES ('$num', '$date', 'KM', '$km');";
    mysql_query($sql5);
    $sql6 = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite)
        VALUES ('$num', '$date', 'NUI', '$nuitee');";
    mysql_query($sql6);
    $sql7 = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite)
        VALUES ('$num', '$date', 'REP', '$midi');";
    mysql_query($sql7);
}
?>
