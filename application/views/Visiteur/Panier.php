<?php echo form_open('Visiteur/ModifierPanier'); ?>
<table cellpadding="6" cellspacing="1" style="width:100%" border="2">
<tr>
        <th>Quantité</th>
        <th>Description</th>
        <th style="text-align:right">Prix</th>
        <th style="text-align:right">Sous-Total</th>
</tr>
<?php $i = 1; ?>
<?php foreach ($this->cart->contents() as $items): ?>
        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <tr>
                <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                <td>
                        <?php echo $items['name']; ?>
                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                <p>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
                                        <?php endforeach; ?>
                                </p>
                        <?php endif; ?>
                </td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right">€<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                <?php echo form_close(); ?>
                <?php echo form_open('Visiteur/SupprimerPanier/'.$items['rowid']); ?>
                <td style="text-align:right"><?php echo form_submit('btnSupprimer', 'Supprimer'); ?></td>
                <?php echo form_close(); ?>
        </tr>
<?php $i++; ?>
<?php endforeach; ?>
<tr>
        <td colspan="2"> </td>
        <td class="right"><strong>Total</strong></td>
        <td class="right">€<?php echo $this->cart->format_number($this->cart->total()); ?></td>
</tr>
</table>
<p><?php echo form_submit('btnModifier', 'Modifier le panier'); ?></p>
                <?php echo form_close(); ?>
                <?php if ($this->session->statut=="user") : ?>
                <?php echo form_open('Visiteur/ValiderPanier'); ?>
                <?php echo form_submit('btnValider', 'Valider'); ?></td>
                <?php echo form_close(); ?>
                <?php else : ?>
                <p><a href="<?php echo site_url('Visiteur/seConnecter') ?>">Se connecter pour valider le panier</a></p>
                <?php endif; ?>
                
