<html>
    <head>
       <title>PlaneteMania</title>
    </head>
    <body>
    <a href="<?php echo site_url('visiteur/Home') ?>">Home</a>&nbsp;&nbsp;
    <a href="<?php echo site_url('visiteur/listerLesArticles') ?>">Lister tous les Articles</a>&nbsp;&nbsp;
    <a href="<?php echo site_url('visiteur/listerLesArticlesAvecPagination') ?>">Lister les Articles (par 3)</a>&nbsp;&nbsp;
    <?php if ($this->session->statut==1) : ?>
       <a href="<?php echo site_url('administrateur/ajouterUnArticle') ?>">Ajouter un article</a>&nbsp;&nbsp;
       <a href="<?php echo site_url('administrateur/supprimerUnArticle') ?>">Supprimer un article</a>&nbsp;&nbsp;
    <?php endif; ?>
     <div align="right">
       <?php if (!is_null($this->session->identifiant)) : ?>
       <?php echo 'Utilisateur connecté : <B>'.$this->session->identifiant.'</B>&nbsp;&nbsp;';?>
       <a href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;
    <?php else : ?>
       <a href="<?php echo site_url('visiteur/seConnecter') ?>">Se Connecter</a>&nbsp;&nbsp;
    <?php endif; ?>
</div>
