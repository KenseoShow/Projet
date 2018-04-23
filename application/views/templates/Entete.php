<html>
<head>
<title>TEST</title>
</head>
<body>
<a href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil</a>
<a href="<?php echo site_url('visiteur/listerLesArticles') ?>">Lister tous les Articles</a>&nbsp;&nbsp;
<?php if (!is_null($this->session->identifiant)): ?>
<?php echo 'Utilisateur connecté : <B>'.$this->session->identifiant.'</B>&nbsp;&nbsp;';?>
<a href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;



<?php if ($this->session->statut=="admin") : ?>
   <a href="<?php echo site_url('administrateur/ajouterUnProduit') ?>">Ajouter un article</a>&nbsp;&nbsp;
   <a href="<?php echo site_url('Administrateur/ajouterUneMarque')?>">Ajouter une Marque</a>&nbsp;&nbsp;
   <a href="<?php echo site_url('Administrateur/ajouterUneCategorie')?>">Ajouter une Catégorie</a>&nbsp;&nbsp;
<?php endif; ?>
<?php else : ?>
<a href="<?php echo site_url('visiteur/seConnecter') ?>">Se Connecter</a>&nbsp;&nbsp;
<a href="<?php echo site_url('visiteur/Inscription') ?>">Inscription</a>&nbsp;&nbsp;
<?php endif; ?>



<?php echo form_open('Visiteur/ResultatRechercher'); ?>
      <input type="text" placeholder="Recherche.." name="recherche">
      <button type="submit">Submit</button>
    </form>
<?php echo form_close();?>
