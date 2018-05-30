<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Visiteur/ModificationUnCompte');

echo form_label("Nom : ", 'lbltNom');
echo form_input('Nom',$Utilisateur->NOM,array('pattern' =>'^[a-zA-Z]{3,8}$','required'=>'required')).'<BR>';

echo form_label("Prenom : ", 'lbltPrenom');
echo form_input('Prenom',$Utilisateur->PRENOM,array('pattern' =>'^[a-zA-Z]{3,8}$','required'=>'required')).'<BR>';

echo form_label("Adresse : ", 'lbltAdresse');
echo form_input('Adresse',$Utilisateur->ADRESSE,array('required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltVille');
echo form_input('Ville',$Utilisateur->VILLE,array('required'=>'required')).'<BR>';

echo form_label("Code Postal : ", 'lbltCP');
echo form_input('CodePostal',$Utilisateur->CODEPOSTAL,array('pattern' =>'^[0-9]{5}$','required'=>'required')).'<BR>';

echo form_label("Email : ", 'lbltEmail');
echo form_input('Email',$Utilisateur->EMAIL,array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';
  
echo form_label("Mot de passe : ", 'lbltMDP');
echo form_password('MotDePasse',$Utilisateur->MOTDEPASSE,array('required'=>'required')).'<BR>';

echo form_submit('boutonModification', 'Modifier Compte').'<BR>';
echo form_close();
?>
<p><a href="<?php echo site_url('Visiteur/Home') ?>">Page d'acceuil</a></p>