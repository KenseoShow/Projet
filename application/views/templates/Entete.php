<html>
<head>
<title>TEST</title>
</head>
<body>
<a href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil</a>
<a href="<?php echo site_url('visiteur/listerLesArticles') ?>">Lister tous les Articles</a>&nbsp;&nbsp;
    <form action="ResultatRechercher">
      <input type="text" placeholder="Recherche.." name="recherche">
      <button type="submit">Submit</button>
    </form>