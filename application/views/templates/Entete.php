<html>
<head>
<title>TEST</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url('visiteur/Home') ?>">Manga</a>&nbsp;&nbsp;
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil</a>&nbsp;&nbsp;</li>
      <li><a href="<?php echo site_url('visiteur/listerLesArticles') ?>">Lister tous les Articles</a>&nbsp;&nbsp;</li>
      <ul class="nav navbar-nav navbar-right">
      <?php if (!is_null($this->session->identifiant)): ?>
      <div class="container">
      <li><p class="text-success"><?php echo 'Utilisateur connecté : <B>'.$this->session->identifiant.'</B>&nbsp;&nbsp;';?></li>
      </div>
      
      <li><a href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;</li>
      </ul>
      <?php if ($this->session->statut=="user") : ?>
      <a href="<?php echo site_url('Visiteur/ModificationUnCompte')?>">Modifier Compte</a>&nbsp;&nbsp;
      <?php endif; ?>
      <?php if ($this->session->statut=="admin") : ?>
      <li><a href="<?php echo site_url('administrateur/ajouterUnProduit') ?>">Ajouter un article</a>&nbsp;&nbsp;</li>
      <li><a href="<?php echo site_url('Administrateur/ajouterUneMarque')?>">Ajouter une Marque</a>&nbsp;&nbsp;</li>
      <li><a href="<?php echo site_url('Administrateur/ajouterUneCategorie')?>">Ajouter une Catégorie</a>&nbsp;&nbsp;</li>
      <li><a href="<?php echo site_url('Administrateur/SupprimerUnProduit')?>">Supprimer Un Produit</a>&nbsp;&nbsp;</li>
      <li><a href="<?php echo site_url('Administrateur/ModificationUnProduit')?>">Modifier Un Produit</a>&nbsp;&nbsp;</li>
      <li><a href="<?php echo site_url('Visiteur/ModificationUnCompte')?>">Modifier Compte</a>&nbsp;&nbsp;</li>
      <?php endif; ?>
    </ul>
  </div>      
<?php else : ?>
<ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo site_url('visiteur/Inscription') ?>"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
      <li><a href="<?php echo site_url('visiteur/seConnecter') ?>"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
    </ul>
<?php endif; ?>


      <?php echo form_open('Visiteur/ResultatRechercher'); ?>
      <input type="text" placeholder="Recherche.." name="recherche">
      <button type="submit">Submit</button>
      <?php echo form_close();?>
</div>
</nav>
</body>