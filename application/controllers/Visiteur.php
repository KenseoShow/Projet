<?php
class Visiteur extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
      $this->load->model('ModeleArticle'); // chargement modèle, obligatoire
      //$this->load->model('ModeleUtilisateur');
   } // __construct

   public function Home() {
    $DonneesInjectees['TitreDeLaPage'] = 'Home';
    $config["base_url"] = site_url('visiteur/Home');
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Home", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
   }// Page d'acceuil

   public function listerLesArticles() // lister tous les articles
   {
      $DonneesInjectees['lesArticles'] = $this->ModeleArticle->retournerArticles();
      $DonneesInjectees['TitreDeLaPage'] = 'Tous les articles';
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/listerLesArticles', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
   } // listerLesArticles

   public function voirUnArticle($noArticle = NULL) // valeur par défaut de noArticle = NULL
   {
     $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerArticles($noArticle);
     if (empty($DonneesInjectees['unArticle']))
     {   // pas d'article correspondant au n°
         show_404();
     }
     $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];
     // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
     $this->load->view('templates/Entete');
     $this->load->view('visiteur/VoirUnArticle', $DonneesInjectees);
     $this->load->view('templates/PiedDePage');
   } // voirUnArticle

   

}  // Visiteur