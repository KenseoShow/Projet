<h2><?php echo $TitreDeLaPage ?></h2>

<?php echo validation_errors();
echo form_open('Visiteur/ajouterUneMarque') ?>

<label for="NomMarque">Marque</label>
<input type="input" name="NomMarque" value="<?php echo set_value('NomMarque'); ?>"/><br/>

<input type="submit" name="submit" value="Ajouter une Marque" />
</form>