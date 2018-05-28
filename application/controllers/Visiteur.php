<?php
class Visiteur extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleArticle');
      $this->load->model('ModeleUtilisateur');
      $this->load->library('cart');
   } // __construct

   public function Home() {
    $DonneesInjectees['TitreDeLaPage'] = 'Home';
    $config["base_url"] = site_url('visiteur/Home');  
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Home", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
   }// Page d'acceuil

   public function listerLesArticles()
   {
      $DonneesInjectees['lesArticles'] = $this->ModeleArticle->retournerArticles();
      $DonneesInjectees['TitreDeLaPage'] = 'Tous les articles';
      $this->load->view('templates/Entete');
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
     else
     {
      $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/VoirUnArticle', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
     }
   } // voirUnArticle

   public function AjouterPanier($noArticle = null)
   {
    $Produitretourne=$this->ModeleArticle->retournerarticle($noArticle);
    $Libelle=$Produitretourne['LIBELLE'];
    $PrixProduit=$Produitretourne['PRIXHT']*(($Produitretourne['TAUXTVA']/100)+1);
    if($this->input->post('btnajouter'))
    {
      $insertion=array(
        'id'=> $noArticle,
        'qty' => 1,
        'price' => $PrixProduit,
        'name' => $Libelle
      );
      $this->cart->insert($insertion);
      $this->load->view('templates/Entete');
     $this->load->view('visiteur/insertionMarqueReussie');
     $this->load->view('templates/PiedDePage');
    }
    else
    {
      $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/VoirUnArticle', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
   } // AjouterPanier

   public function ViderPanier()
   {
    if($this->input->post('btnajouter'))
    {
      $this->cart->destroy();
    }
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Home';
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/Home', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
   } // ViderPanier


   public function Rechercher()
   { 
     $DonneesInjectees['TitreDeLaPage'] = 'Recherche';
     $this->load->view('templates/Entete');
     $this->load->view('Visiteur/Rechercher', $DonneesInjectees);
     $this->load->view('templates/PiedDePage');
   } // RechercherUnArticle

   public function ResultatRechercher()
   { 
    $Libelle = $this->input->post('recherche');
    if (empty($Libelle))
     {   // pas d'article correspondant au n°
         show_404();
     }
    $DonneesInjectees['Search'] = $this->ModeleArticle->RechercherUnArticle($Libelle);
    $DonneesInjectees['TitreDeLaPage'] = 'Resultats de votre recherche';
    $this->load->view('templates/Entete');
    $this->load->view('Visiteur/ResultatRechercher', $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
  } // ResultatRechercheUnArticle

   
  public function Inscription()
  {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Inscription';
      If ($this->input->post('boutonInscription'))
      {
        $donneesAInserer = array(
          'NOM' => $this->input->post('Nom'),
          'PRENOM' => $this->input->post('Prenom'),
          'ADRESSE' => $this->input->post('Adresse'),
          'VILLE' => $this->input->post('Ville'),
          'CODEPOSTAL' => $this->input->post('CodePostal'),
          'EMAIL' => $this->input->post('Email'),
          'MOTDEPASSE' => $this->input->post('MotDePasse'),
          'PROFIL' => 'client',
        );
        $this->ModeleArticle->insererInscription($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/InscriptionReussie');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('visiteur/Inscription', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
  } // Inscription

  public function seConnecter()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $DonneesInjectees['TitreDeLaPage'] = 'Se connecter';
    $this->form_validation->set_rules('txtEmail', 'Identifiant', 'required');
    $this->form_validation->set_rules('txtMotDePasse', 'Mot de passe', 'required');
    if ($this->form_validation->run() === FALSE)
      { 
        $this->load->view('templates/Entete');
        $this->load->view('visiteur/seConnecter', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
        else
          { 
            $Utilisateur = array( // EMAIL, MOTDEPASSE : champs de la table client
            'EMAIL' => $this->input->post('txtEmail'),
            'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
                                );
            $UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);
                if (!($UtilisateurRetourne == null))
                  {    // on a trouvé, identifiant et statut (droit) sont stockés en session
                      
                      $this->session->identifiant = $UtilisateurRetourne->EMAIL;
                      $this->session->statut = $UtilisateurRetourne->PROFIL;
                      $DonneesInjectees['Identifiant'] = $Utilisateur['EMAIL'];
                      $this->load->view('templates/Entete');
                      $this->load->view('visiteur/connexionReussie', $DonneesInjectees);
                      $this->load->view('templates/PiedDePage');
                  }
                    else
                        {    // utilisateur non trouvé on renvoie le formulaire de connexion
     
                        $this->load->view('visiteur/seConnecter', $DonneesInjectees);
                        $this->load->view('templates/PiedDePage');
                        }  
          }
  } // fin seConnecter

  public function seDeConnecter() 
  { // destruction de la session = déconnexion
    $this->session->sess_destroy();
    $DonneesInjectees['TitreDeLaPage'] = 'Deconnection';
    $this->load->view('templates/Entete');
    $this->load->view('Visiteur/seDeconnecter', $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
  } // fin seDeConnecter

  public function ModificationUnCompte()
  {
    if ($this->session->statut=="admin"|| $this->session->statut=="user" )
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier son Compte';
      If ($this->input->post('boutonModification'))
      {
       $donneesAInserer = array(
            'NOM' => $this->input->post('Nom'),
           'PRENOM' => $this->input->post('Prenom'),
            'ADRESSE' => $this->input->post('Adresse'),
            'VILLE' => $this->input->post('Ville'),
            'CODEPOSTAL' => $this->input->post('CodePostal'),
            'EMAIL' => $this->input->post('Email'),
           'MOTDEPASSE' => $this->input->post('MotDePasse'),
        );
        $id = $this->session->identifiant;
        $this->ModeleUtilisateur->ModificationUnCompte($donneesAInserer, $id);// appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
       $this->load->view('templates/Entete');
        $this->load->view('Visiteur/ModificationUnCompteReussie');
      }
      else
      {
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/ModificationUncompte', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
      }
    }
    else
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Se connecter';
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/seConnecter', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  } // ModificationCompte

  public function panier() 
  {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Panier';
        $this->load->view('templates/Entete');
        $this->load->view('visiteur/Panier', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
   }// Panier

}  // Visiteur