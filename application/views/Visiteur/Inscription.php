<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Visiteur/Inscription');

echo form_label("Nom : ", 'lbltNom');
echo form_input('Nom','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Prenom : ", 'lbltPrenom');
echo form_input('Prenom','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Adresse : ", 'lbltAdresse');
echo form_input('Adresse','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltVille');
echo form_input('Ville','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Code Postal : ", 'lbltCP');
echo form_input('Ville','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Email : ", 'lbltEmail');
echo form_input('Email','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';
  
echo form_label("Mot de passe : ", 'lbltMDP');
echo form_input('MotDePasse','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Profil : ", 'lbltProfil');
echo form_input('Profil','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_submit('boutonInscription', 'Inscription').'<BR>';
echo form_close();
?>