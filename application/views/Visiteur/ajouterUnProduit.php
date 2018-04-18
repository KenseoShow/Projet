<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Visiteur/ajouterUnProduit');
echo form_label("Numero du produit : ", 'lbltNoProduit');
echo form_input('NoProduit','',array('pattern' =>'[0-9]*','required'=>'required', 'title'=>'Saisir des nombres uniquement')).'<BR>';

echo form_label("Numero de categorie : ", 'lbltNoCategorie');
echo form_dropdown('NoCategorie', $lesCategories,'').'<BR>';

echo form_label("Numero de marque : ", 'lbltNoMarque');
echo form_dropdown('NoMarque', $lesMarques,'').'<BR>';

echo form_label("Le libelle du produit : ", 'lbltLibelleProduit');
echo form_input('LibelleProduit','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Le detail du produit : ", 'lbltDetailProduit');
echo form_input('DetailProduit','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Le prix HT du produit : ", 'lbltPrixHTProduit');
echo form_input('PrixHTProduit','',array('pattern' =>'[0-9]*','required'=>'required', 'title'=>'Saisir des nombres uniquement')).'<BR>';

echo form_label("Le taux TVA du produit : ", 'lbltTauxTVAProduit');
echo form_input('TauxTVAProduit','',array('pattern' =>'[0-9]*','required'=>'required', 'title'=>'Saisir des nombres uniquement')).'<BR>';

echo form_label("Le nominage du produit : ", 'lbltNominageProduit');
echo form_input('NominageProduit','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*')).'<BR>';

echo form_label("La quantité en stock du produit : ", 'lbltQuantiteStockProduit');
echo form_input('QuantiteStockProduit','',array('pattern' =>'[0-9]*','required'=>'required', 'title'=>'Saisir des nombres uniquement')).'<BR>';

echo form_label("La date d'ajout : ", 'lbltLadateDajout');
echo form_input('DateAjout','',array('pattern' =>'[0-9]*','required'=>'required', 'title'=>'Saisir des nombres uniquement')).'<BR>';

echo form_label("Produit disponible : ", 'lbltDisponibleProduit');
echo form_radio('DisponibleProduit', '1', TRUE).'<BR>';
echo form_label("Produit indisponible : ", 'lbltIndisponibleProduit');
echo form_radio('DisponibleProduit', '0', FALSE).'<BR>';

echo form_submit('boutonAjouter', 'Ajouter un article').'<BR>';
echo form_close();
?>