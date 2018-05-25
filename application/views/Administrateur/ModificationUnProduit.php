<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ModificationUnProduit');

echo form_label("Le produit à modifier : ", 'lbltNoProduit');
?>
<select name="NoProduit" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($lesProduits as $unProduit)
{
    echo '<option value ="'.$unProduit['NOPRODUIT'].'">'.$unProduit['LIBELLE'].'</option>';
}
?>
</select><BR>

<?php
echo form_label("Numero de categorie : ", 'lbltNoCategorie');
?>
<select name="NoCategorie" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($lesCategories as $uneCategorie)
{
    echo '<option value ="'.$uneCategorie['NOCATEGORIE'].'">'.$uneCategorie['LIBELLE'].'</option>';
}
?>
</select><BR>

<?php
echo form_label("Numero de marque : ", 'lbltNoMarque');
?>
<select name="NoMarque" required>
<option value="" selected>Selectionner</option>
<?php
foreach($lesMarques as $uneMarque)
{
    echo '<option value="'.$uneMarque['NOMARQUE'].'">'.$uneMarque['NOM'].'</option>';
}
?>
</select><BR>
<?php

echo form_label("Le libelle du produit : ", 'lbltLibelleProduit');
echo form_input('LibelleProduit','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Le detail du produit : ", 'lbltDetailProduit').'<BR>';
echo form_textarea('DetailProduit','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*','required'=>'required')).'<BR>';

echo form_label("Le prix HT du produit : ", 'lbltPrixHTProduit');
echo form_input('PrixHTProduit','',array('pattern' =>'[0-9]*', 'title'=>'Saisir des nombres uniquement','required'=>'required')).'<BR>';

echo form_label("Le taux TVA du produit : ", 'lbltTauxTVAProduit');
echo form_input('TauxTVAProduit','',array('pattern' =>'[0-9]*', 'title'=>'Saisir des nombres uniquement','required'=>'required')).'<BR>';

echo form_label("Le nominage du produit : ", 'lbltNominageProduit');
echo form_input('NominageProduit','',array('pattern' =>'^[a-zA-Z][a-zA-Z0-9]*')).'<BR>';

echo form_label("La quantité en stock du produit : ", 'lbltQuantiteStockProduit');
echo form_input('QuantiteStockProduit','',array('pattern' =>'[0-9]*', 'title'=>'Saisir des nombres uniquement','required'=>'required')).'<BR>';

echo form_label("La date d'ajout : ", 'lbltLadateDajout');?>
<input type="date" class="form-control" name="DateAjout" value="<?php echo isset($itemOutData->DateAjout) ? set_value('DateAjout', date('Y-m-d', strtotime($itemOutData->DateAjout))) : set_value('DateAjout'); ?>"><BR>
<?php

echo form_label("Produit disponible : ", 'lbltDisponibleProduit');
echo form_radio('DisponibleProduit', '1', TRUE).'<BR>';
echo form_label("Produit indisponible : ", 'lbltIndisponibleProduit');
echo form_radio('DisponibleProduit', '0', FALSE).'<BR>';

echo form_submit('boutonModification', 'Modifier un article').'<BR>';
echo form_close();
?>