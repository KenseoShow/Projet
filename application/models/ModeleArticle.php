<?php
class ModeleArticle extends CI_Model {

public function __construct()
{
$this->load->database();
/* chargement database.php (dans config), obligatoirement dans le constructeur */
}
     public function retournerArticles($pNoArticle = FALSE)
     {
        if ($pNoArticle === FALSE) // pas de n° d'article en paramètre
        {  // on retourne tous les articles

             $requete = $this->db->get('produit');
             return $requete->result_array(); // retour d'un tableau associatif
        }
        // ici on va chercher l'article dont l'id est $pNoArticle
        $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoArticle));
        return $requete->row_array(); // retour d'un tableau associatif
     } // fin retournerArticles

     public function insererUneMarque($pDonneesAInserer)
     {
         return $this->db->insert('marque', $pDonneesAInserer);
     } // insererUneMarque

     public function insererUneCategorie($pDonneesAInserer)
     {
         return $this->db->insert('categorie', $pDonneesAInserer);
     } // insererUneCatégorie

     public function RechercherUnArticle($pLibelle)
     {
        $this->db->like('LIBELLE', $pLibelle, 'after');
        $requete = $this->db->get('produit');
        return $requete->row_array(); // retour d'un tableau associatif
     } //RechercherUnProduit

} // Fin Classe