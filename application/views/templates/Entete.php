<html>
<head>
<title>TEST</title>
</head>
<body>
<?php if (!is_null($this->session->Identifiant)): ?>
<?php echo 'Utilisateur connecté : <B>'.$this->session->Identifiant.'</B>&nbsp;&nbsp;';?>
<a href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a>&nbsp;&nbsp;

<?php if ($Profil=="admin") : ?>
   <a href="<?php echo site_url('administrateur/ajouterUnProduit') ?>">Ajouter un article</a>&nbsp;&nbsp;
<?php endif; ?>
<?php else : ?>
<a href="<?php echo site_url('visiteur/seConnecter') ?>">Se Connecter</a>&nbsp;&nbsp;
<a href="<?php echo site_url('visiteur/Inscription') ?>">Inscription</a>&nbsp;&nbsp;
<?php endif; ?>

<a href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil</a>
<a href="<?php echo site_url('visiteur/listerLesArticles') ?>">Lister tous les Articles</a>&nbsp;&nbsp;

<?php echo form_open('Visiteur/ResultatRechercher'); ?>
      <input type="text" placeholder="Recherche.." name="recherche">
      <button type="submit">Submit</button>
    </form>
<?php echo form_close();?>

