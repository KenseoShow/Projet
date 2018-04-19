<h2><?php echo $TitreDeLaPage ?></h2>

<?php 
foreach ($Search as $UnArticles)
{
    echo '<h3>'.anchor('visiteur/voirUnArticle/'.$UnArticles['NOPRODUIT'],$UnArticles['LIBELLE']).'</h3>';
}
?>
