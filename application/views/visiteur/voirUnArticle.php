<?php
echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
echo $unArticle['DETAIL'];
echo '<p>'.$unArticle['PRIXHT'].'€</p>';
echo '<p>'.anchor('visiteur/listerLesArticles','Retour à la liste des articles').'</p>'; ?>

<p><a href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil</a></p>