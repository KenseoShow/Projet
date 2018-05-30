<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ValidationCommande');

echo form_label("Les commandes : ", 'lbltNoCommande');
?>
<select name="NoCommande" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($lesCommandes as $unCommande)
{
    echo '<option value ="'.$unCommande['NOCOMMANDE'].'">'.$unCommande['NOCOMMANDE'].'</option>';
}
?>
</select><BR>

<?php
echo form_submit('boutonValider', 'Valider').'<BR>';
echo form_close();
?>