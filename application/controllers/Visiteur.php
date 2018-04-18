<?php
class Visiteur extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->view('templates/Entete');
      //$this->load->model('ModeleUtilisateur');
   } // __construct

   public function Home() {
    $DonneesInjectees['TitreDeLaPage'] = 'Home';
    $config["base_url"] = site_url('visiteur/Home');  
    $this->load->view("visiteur/Home", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
   }// Page d'acceuil

   public function listerLesArticles()
   {
      $DonneesInjectees['lesArticles'] = $this->ModeleArticle->retournerArticles();
      $DonneesInjectees['TitreDeLaPage'] = 'Tous les articles';
      $this->load->view('visiteur/listerLesArticles', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
   } // listerLesArticles

   public function voirUnArticle($noArticle = NULL)
   {
     $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerArticles($noArticle);
     if (empty($DonneesInjectees['unArticle']))
     {   // pas d'article correspondant au n°
         show_404();
     }
     $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];
     $this->load->view('visiteur/VoirUnArticle', $DonneesInjectees);
     $this->load->view('templates/PiedDePage');
   } // voirUnArticle

   public function Rechercher()
   { 
     $DonneesInjectees['TitreDeLaPage'] = 'Recherche';
     $this->load->view('Visiteur/Rechercher', $DonneesInjectees);
     $this->load->view('templates/PiedDePage');
   } // RechercherUnArticle

   public function ResultatRechercher()
   { 
    $Libelle = $this->input->post('recherche');
    var_dump($Libelle);
    if (empty($Libelle))
     {   // pas d'article correspondant au n°
         show_404();
     }
    $DonneesInjectees['search'] = $this->ModeleArticle->RechercherUnArticle($Libelle);
    $DonneesInjectees['TitreDeLaPage'] = 'Resultats de votre recherche';
    $this->load->view('Visiteur/ResultatRechercher', $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
  } // ResultatRechercheUnArticle

   public function ajouterUneMarque()
  {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter une marque';
      $this->form_validation->set_rules('NoMarque', 'NumeroMarque', 'required');
      $this->form_validation->set_rules('NomMarque', 'Marque', 'required');
      if ($this->form_validation->run() === FALSE)
      {   // formulaire non validé, on renvoie le formulaire

        $this->load->view('Visiteur/ajouterUneMarque', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
      else
      {
        $donneesAInserer = array(
        'NOMARQUE' => $this->input->post('NoMarque'),
        'NOM' => $this->input->post('NomMarque'),
        ); // NOMARQUE, NOM : champs de la table tabarticle
        $this->ModeleArticle->insererUneMarque($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('Visiteur/insertionMarqueReussie');
      }
  } // ajouterUneMarque

  public function ajouterUneCategorie()
  {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter une catégorie';
      $this->form_validation->set_rules('NoCategorie', 'NumeroCategorie', 'required');
      $this->form_validation->set_rules('NomCategorie', 'Categorie', 'required');
      if ($this->form_validation->run() === FALSE)
      {   // formulaire non validé, on renvoie le formulaire

        $this->load->view('Visiteur/ajouterUneCategorie', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
      else
      {
        $donneesAInserer = array(
        'NOCATEGORIE' => $this->input->post('NoCategorie'),
        'LIBELLE' => $this->input->post('NomCategorie'),
        ); // NOCATEGORIE, LIBELLE : champs de la table tabarticle
        $this->ModeleArticle->insererUneCategorie($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('Visiteur/insertionCategorieReussie');
      }
  } // ajouterUneCatégorie

  public function ajouterUnProduit()
  {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un Produit';
      $DonneesInjectees['lesCategories'] = $this->ModeleArticle->TouteslesCatégories();
      $DonneesInjectees['lesMarques'] = $this->ModeleArticle->TouteslesMarques();
      var_dump($DonneesInjectees);
      If ($this->input->post('boutonAjouter'))
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
        $this->ModeleArticle->insererUnProduit($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('Visiteur/ajouterUnProduitReussie');
      }
      else
      {
        $this->load->view('visiteur/ajouterUnProduit', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
  } // ajouterUnProduit

}  // Visiteur