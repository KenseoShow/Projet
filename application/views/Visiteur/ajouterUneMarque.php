<h2><?php echo $TitreDeLaPage ?></h2>

<?php echo validation_errors();
echo form_open('Visiteur/ajouterUneMarque') ?>

<label for="NoMarque">Numéro de la Marque</label>
<input type="input" name="NoMarque" value="<?php echo set_value('NoMarque'); ?>" /><br/>

<label for="NomMarque">Marque</label>
<input type="input" name="NomMarque" value="<?php echo set_value('NomMarque'); ?>"/><br/>

<input type="submit" name="submit" value="Ajouter une Marque" />
</form>