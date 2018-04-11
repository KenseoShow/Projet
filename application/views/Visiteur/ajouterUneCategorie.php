<h2><?php echo $TitreDeLaPage ?></h2>

<?php echo validation_errors();
echo form_open('Visiteur/ajouterUneCategorie') ?>

<label for="NoCategorie">Numéro de la catégorie</label>
<input type="input" name="NoCategorie" value="<?php echo set_value('NoCategorie'); ?>" /><br/>

<label for="NomCategorie">Catégorie</label>
<input type="input" name="NomCategorie" value="<?php echo set_value('Categorie'); ?>"/><br/>

<input type="submit" name="submit" value="Ajouter une Catégorie" />
</form>