
<?php
    include_once('entete.php');
    $idjeu = $_GET['id'];
    
    function get_jeux($idjeu){ //récupère tous les jeux
        global $bdd;
        $req = $bdd -> prepare("SELECT * from jeux as j, categorie as c, age as a where IDJeux=$idjeu and j.IDCateg = c.IDCategorie and j.IDAge = a.IDAge");
        $req -> execute();
        $get_jeux = $req -> fetch();
        return $get_jeux;
    }
    
    $jeu=get_jeux($idjeu);
    $nom = $jeu['NomJeu'];
    $img = $jeu['Image'];
    $desc = $jeu['Descriptif'];
    $prix = $jeu['Prix'];
    $date = $jeu['DateDeSortie'];
    $stock = $jeu['Stock'];
    $categ = $jeu['NomCateg'];
    $age = $jeu['TrancheAge'];
?>

<table>
    <tr class='titre_case'>
        <td class='hidden' rawspan='2'><?php echo $nom;?></td>
    </tr>
    <tr>
        <td class='hidden' rawspan='2'><?php echo $img; ?></td>
    </tr>
    <tr>
        <td class='hidden' rawspan='2'><?php echo $desc;?></td>  
    </tr>
    <tr>
        
    </tr>
    <tr>
        <td class='hidden'><?php echo $age; ?> ans</td>
        <td class='hidden'><?php echo $categ; ?></td> 
    </tr>
    <tr>
        <td class='hidden'><?php echo $date; ?></td>
    </tr>
    <tr>
        <td class='hidden'>
            <?php if ($stock > 0){
            echo $prix; ?> €
            <td class='hidden'><img id='addpanier' src='images/panier_fleche.jpg'/> </td>
            <?php } else { ?>
            Indisponible pour le moment
            <?php } ?>
        </td>
    </tr>
</table>

<?php 
    include_once('foot.php');
?>