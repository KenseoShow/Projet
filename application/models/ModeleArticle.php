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

     public function insererUnProduit($pDonneesAInserer)
     {
         return $this->db->insert('produit', $pDonneesAInserer);
     } // insererUnProduit

     public function SupprimerUnProduit($pDonneesAInserer, $id)
     {
        $this->db->where('NOPRODUIT', $id);
        return $this->db->update('produit', $pDonneesAInserer);
     } // SupprimerUnProduit

     public function ModificationUnProduit($pDonneesAInserer, $id)
     {
        $this->db->where('NOPRODUIT', $id);
        return $this->db->update('produit', $pDonneesAInserer);
     } // SupprimerUnProduit

     public function insererInscription($pDonneesAInserer)
     {
         return $this->db->insert('client', $pDonneesAInserer);
     } // insererUneCatégorie

     public function RechercherUnArticle($pLibelle = False)
     {
        $this->db->like('LIBELLE', $pLibelle, 'after');
        $requete = $this->db->get('produit');
        return $requete->result_array(); // retour d'un tableau associatif
     } //RechercherUnProduit

     public function TouteslesCatégories()
    {
        $requete = $this->db->get('categorie');
        return $requete->result_array();
    }

     public function TouteslesMarques()
    {
        $requete = $this->db->get('marque');
        return $requete->result_array();
    }

     public function TouteslesProduits()
    {
        $requete = $this->db->get('produit');
        return $requete->result_array();
    }
    public function retournerarticle($pNoArticle)
    {
        $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoArticle));
        return $requete->row_array();

    } //retournerArticle

    public function retournerArticlesLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
    {// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $requete = $this->db->get("produit");
        if ($requete->num_rows() > 0) { // si nombre de lignes > 0
        foreach ($requete->result() as $ligne) 
        {
        $jeuDEnregsitrements[] = $ligne;
        }
        return $jeuDEnregsitrements;
        } // fin if
        return false;
    } // retournerArticlesLimite

    public function nombreDArticles() 
    { // méthode utilisée pour la pagination
        return $this->db->count_all("produit");
    } // nombreDArticles

    public function insererCommande($pDonneesAInserer)
     {
         return $this->db->insert('commande', $pDonneesAInserer);
     } // insererUneCommande

     public function insererLigne($pDonneesAInserer)
     {
         return $this->db->insert('ligne', $pDonneesAInserer);
     } // insererUneCommande

     public function reducstock($pDonneesAInserer, $id)
     {
        $this->db->where('NOPRODUIT', $id);
        return $this->db->update('produit', $pDonneesAInserer);
     } // Modifierstock

     public function nombreDecommande() 
     {
        $this->db->select_max('NOCOMMANDE');
        $requete = $this->db->get('commande');
        return $requete->row(0);
     } // nombreDeCommande

     public function retournerclient($pNomclient)
    {
        $requete = $this->db->get_where('client', array('EMAIL' => $pNomclient));
        return $requete->row_array();

    } //retournerArticle

    public function TouteslesCommandes($Noproduit)
    {
        $requete = $this->db->get('commande');
        return $requete->result_array();
    }

    public function nombreenstock($Noproduit)
    {
        $this->db->where('NOPRODUIT', $Noproduit);
        $requete = $this->db->get('produit');
        return $requete->row_array();
        /*$this->db->select('QUANTITEENSTOCK');
        $requete = $this->db->get('produit');
        return $requete->row(0);*/
    }


} // Fin Classe