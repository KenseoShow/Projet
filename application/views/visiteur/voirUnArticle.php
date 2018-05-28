<?php

echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
echo $unArticle['DETAIL'];
echo '<p>'.$unArticle['PRIXHT'].'€</p>';

if ($unArticle['QUANTITEENSTOCK']==0 or $unArticle['DISPONIBLE']==0)
{
    echo '<h1> Indisponible </ha>';
}
else 
{
    echo form_open('Visiteur\AjouterPanier/'.$unArticle['NOPRODUIT']);
    echo form_submit('btnajouter', 'ajouter').'<BR>';
    echo form_close();
}


echo '<p>'.anchor('visiteur/listerLesArticles','Retour à la liste des articles').'</p>'; ?>

<p><a href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil</a></p>