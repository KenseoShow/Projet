<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/SupprimerUnProduit');

echo form_label("Le produit à supprimer : ", 'lbltNoProduit');
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

echo form_submit('boutonSupprimer', 'Supprimer un article').'<BR>';
echo form_close();
?>