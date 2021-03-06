
<?php
    include_once('entete.php');
    $idjeu = $_GET['id'];
    
    function get_jeux($idjeu){ //récupère le jeu dont on a donné l'ID
        global $bdd;
        $req = $bdd -> prepare("SELECT * from jeux as j, categorie as c, age as a where IDJeux=$idjeu and j.IDCateg = c.IDCategorie and j.IDAge = a.IDAge");
        $req -> execute();
        $get_jeux = $req -> fetch();
        return $get_jeux;
    }
    function dateFR($datePHP1) // transforme la date anglaise (de la base) en date française
    {
        list($AAAA, $MM, $JJ) = explode("-", $datePHP1);
        $datePHP2 = $JJ."-".$MM."-".$AAAA;

        return $datePHP2;
    }
    
    
    $jeu=get_jeux($idjeu);
    
    //récupère les infos
    $id= $jeu['IDJeux'];
    $nom = $jeu['NomJeu'];
    $img = $jeu['Image'];
    $desc = $jeu['Descriptif'];
    $date = dateFR($jeu['DateDeSortie']);
    $stock = $jeu['Stock'];
    $categ = $jeu['NomCateg'];
    $age = $jeu['TrancheAge'];
    
    //puis les affiche
?>

<table>
    <tr class='titre_case'>
        <td class='hidden detailjeu' colspan="3"><?php echo $nom;?></td>
    </tr>
    <tr>
        <td class='hidden detailjeu' rowspan='3'><img class="produitdetail" src='images/produits/<?php echo $img; ?>' alt='<?php echo $img; ?>'/></td>
        <td class='hidden detailjeu' rowspan="3"><?php echo $desc;?></td>  
        <td class='hidden detailjeu'><?php echo $age; ?> ans</td>
    </tr>
    <tr>
        <td class='hidden detailjeu'><?php echo $categ; ?></td> 
    </tr>
    <tr>
        <td class='hidden detailjeu' colspan="2"><?php echo $date; ?></td>
    </tr>
    <tr>
        <td class='hidden detailjeu'>
            <?php if ($stock > 0): ?>
                <td class='hidden detailjeu'><img class='addpanier' id="<?php echo $id; ?>"src='images/panier_fleche.jpg' alt='panier_fleche.jpg'/> </td>
            <?php else: ?>
                <td class="hidden detailjeu">Indisponible pour le moment</td>
            <?php endif; ?>
        </td>
    </tr>
</table>

<?php 
    include_once('foot.php');
?>

<script>
    $(".addpanier").click(function (){ //requête AJAX pour ajouter un jeu au panier grâce à son identifiant
        var id = $(this).attr('id');
        $.ajax({
                  type:'POST',
                  url:'gestpanier.php',
                  data:{
                      status : 1,
                      id : id
                  },
                  success: function(data,textStatus,jqXHR){
                        $(data).prependTo('table');
                  },
                  error: function(jqXHR, textStatus,errorThrown){
                      alert('une erreur s\'est produite');
                  }
                });
    });
</script>