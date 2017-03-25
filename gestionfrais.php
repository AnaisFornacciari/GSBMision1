<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="design.css" rel="stylesheet" media="screen">
        <title>GSB</title>
    </head>
    <body>
        <ul id="nav">
            <li><img src="util\logo.jpg"></li>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="gestionfrais.php">Gestion des Frais</a></li>
        </ul>
        <br>
        <br>
        <?php
        date_default_timezone_set('Europe/Paris');
        include 'fonctions.php';
        if(isset($_REQUEST['num']) && isset($_REQUEST['mois']) && isset($_REQUEST['annee']) && isset($_REQUEST['midi']) && isset($_REQUEST['nuitee'])&& isset($_REQUEST['etape']) && isset($_REQUEST['km']))
        {
            $num = $_REQUEST['num'];
            $date = $_REQUEST['annee'].$_REQUEST['mois'];
            $midi = $_REQUEST['midi'];
            $nuitee = $_REQUEST['nuitee'];
            $etape = $_REQUEST['etape'];
            $km = $_REQUEST['km'];
            if(VerifCompte($num))
            {
                if(VerifFiche($num, $date))
                {
                    InsertFiche($num, $date, $midi, $nuitee, $etape, $km);
                    InsertLigneFrais($num, $date, $midi, $nuitee, $etape, $km);
                    $result = "Fiche de frais ajoutée à ce mois !";
                }
                else
                {
                    $result = "Vous avez déjà entré une fiche de frais à cette date.";
                }
            }
            else
            {
                $result = "Votre numéro de visiteur est erroné. Veuillez réessayer.";
            }
        }
        
        if(isset($result))
        {
            ?> <FONT color="red"> <?php echo($result); ?> </FONT> <?php
        }
        ?>
        
        <form method="post" action="gestionfrais.php">
            <table>
                <tr>
                    <td> <h1>Saisie</h1> </td>
                </tr>
                <tr>
                    <td>
                        VISITEUR :
                    </td>
                    <td>
                        &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <label for="numero">Numéro</label> :
                    </td>
                    <td>
                        <input type="text" name="num" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        PERIODE D'ENGAGEMENT :
                    </td>
                    <td>
                        &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <label for="mois">Mois (2 chiffres)</label> : &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="number" name="mois" min="1" max="12" required/>
                    </td>
                    <td>
                        <label for="annee">Année (4 chiffres)</label> : &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="number" name="annee" max="<?php echo date('Y'); ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td> <h1>Frais au forfait</h1> </td>
                </tr>
                <tr>
                    <td>
                        <label for="midi">Repas midi</label> : &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="number" name="midi" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nuitee">Nuitées</label> : &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="number" name="nuitee" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="etape">Etape</label> : &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="number" name="etape" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="km">Km</label> : &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="number" name="km" required/>
                    </td>
                    <td>
                        &nbsp; &nbsp; &nbsp;
                    </td>
                    <td>
                        <input type="submit" value="Valider"/>
                    </td>
                </tr>
            </table>
            <FONT color=#58ACFA> <i> Saisir des quantités (s'il n'y a pas de frais pour un forfait, taper 0) </i> </FONT>
        </form>
        
    </body>
</html>
