<?php
class Administrateur extends CI_Controller 
{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleUtilisateur');
       $this->load->model('ModeleArticle');
       $this->load->library('session');
       if ($this->session->statut != "admin") // 0 : statut visiteur
       {
            $this->load->helper('url'); // pour utiliser redirect
            redirect('/visiteur/seConnecter'); // pas les droits : redirection vers connexion
       }
    } // __construct

    public function ajouterUneMarque()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter une marque';
      $this->form_validation->set_rules('NomMarque', 'Marque', 'required');
      if ($this->form_validation->run() === FALSE)
      {   // formulaire non validé, on renvoie le formulaire
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ajouterUneMarque', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
      else
      {
        $donneesAInserer = array(
        'NOM' => $this->input->post('NomMarque'),
        ); // NOMARQUE, NOM : champs de la table tabarticle
        $this->ModeleArticle->insererUneMarque($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/insertionMarqueReussie');
      }
    } // ajouterUneMarque

    public function ajouterUneCategorie()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter une catégorie';
      $this->form_validation->set_rules('NomCategorie', 'Categorie', 'required');
      if ($this->form_validation->run() === FALSE)
      {   // formulaire non validé, on renvoie le formulaire
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ajouterUneCategorie', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
      else
      {
        $donneesAInserer = array(
        'LIBELLE' => $this->input->post('NomCategorie'),
        ); // NOCATEGORIE, LIBELLE : champs de la table tabarticle
        $this->ModeleArticle->insererUneCategorie($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/insertionCategorieReussie');
      }
    } // ajouterUneCatégorie

  public function ajouterUnProduit()
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un Produit';
      $DonneesInjectees['lesCategories'] = $this->ModeleArticle->TouteslesCatégories();
      $DonneesInjectees['lesMarques'] = $this->ModeleArticle->TouteslesMarques();
      If ($this->input->post('boutonAjouter'))
      {
        $donneesAInserer = array(
          'NOCATEGORIE' => $this->input->post('NoCategorie'),
          'NOMARQUE' => $this->input->post('NoMarque'),
          'LIBELLE' => $this->input->post('LibelleProduit'),
          'DETAIL' => $this->input->post('DetailProduit'),
          'PRIXHT' => $this->input->post('PrixHTProduit'),
          'TAUXTVA' => $this->input->post('TauxTVAProduit'),
          'NOMIMAGE' => $this->input->post('NominageProduit'),
          'QUANTITEENSTOCK' => $this->input->post('QuantiteStockProduit'),
          'DATEAJOUT' => $this->input->post('DateAjout'),
          'DISPONIBLE' => '1',
        );
        $this->ModeleArticle->insererUnProduit($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ajouterUnProduitReussie');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ajouterUnProduit', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUnProduit

    public function SupprimerUnProduit()
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Supprimer un produit';
      $DonneesInjectees['lesProduits'] = $this->ModeleArticle->TouteslesProduits();
      If ($this->input->post('boutonSupprimer'))
      {
        $donneesAInserer = array(
          'NOPRODUIT' => $this->input->post('NoProduit'),
          'DISPONIBLE' => '0',
        );
        $id = $this->input->post('NoProduit');
        $this->ModeleArticle->SupprimerUnProduit($donneesAInserer, $id);// appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/SuppressionUnProduitReussie');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/SupprimerUnProduit', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // SupprimerUnProduit

    public function ModificationUnProduit()
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modification un produit';
      $DonneesInjectees['lesProduits'] = $this->ModeleArticle->TouteslesProduits();
      $DonneesInjectees['lesCategories'] = $this->ModeleArticle->TouteslesCatégories();
      $DonneesInjectees['lesMarques'] = $this->ModeleArticle->TouteslesMarques();
      If ($this->input->post('boutonModification'))
      {
        $donneesAInserer = array(
          'NOPRODUIT' => $this->input->post('NoProduit'),
          'NOCATEGORIE' => $this->input->post('NoCategorie'),
          'NOMARQUE' => $this->input->post('NoMarque'),
          'LIBELLE' => $this->input->post('LibelleProduit'),
          'DETAIL' => $this->input->post('DetailProduit'),
          'PRIXHT' => $this->input->post('PrixHTProduit'),
          'TAUXTVA' => $this->input->post('TauxTVAProduit'),
          'NOMIMAGE' => $this->input->post('NominageProduit'),
          'QUANTITEENSTOCK' => $this->input->post('QuantiteStockProduit'),
          'DATEAJOUT' => $this->input->post('DateAjout'),
          'DISPONIBLE' => $this->input->post('DisponibleProduit')
          
        );
        $id = $this->input->post('NoProduit');
        $this->ModeleArticle->ModificationUnProduit($donneesAInserer, $id);// appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ModificationUnProduitReussie');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ModificationUnProduit', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ModificationUnProduit
}