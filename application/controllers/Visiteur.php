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

   public function ValiderPanier()
   {
    $DonneesInjectees['TitreDeLaPage'] = 'Panier';
    if($this->input->post('btnValider'))
    {
      $Nomclient= $this->session->identifiant;
      $Noclient= $this->ModeleArticle->retournerclient($Nomclient)['NOCLIENT'];
      $insertioncommande=array(
        'NOCLIENT'=> $Noclient,
        'DATECOMMANDE' => date("y-m-d h:i:s"),
      );
      $this->ModeleArticle->insererCommande($insertioncommande);
      $Nocommande= $this->ModeleArticle->nombreDecommande()->NOCOMMANDE;
      
      
      if ($panier= $this->cart->contents())
      {
        foreach ($panier as $stock)
        {
          $id= $stock['id'];
          $Enstock = $this->ModeleArticle->nombreenstock($id);
          $insertionligne=array( 
            'QUANTITEENSTOCK' => $Enstock["QUANTITEENSTOCK"] -  $stock['qty'] 
          );

          $this->ModeleArticle->reducstock($insertionligne,$id);
        }
        foreach ($panier as $objet)
        {
          $insertionligne=array(
            'NOCOMMANDE' => $Nocommande,
            'NOPRODUIT' => $objet['id'],
            'QUANTITECOMMANDEE' => $objet['qty']
          );
          $this->ModeleArticle->insererLigne($insertionligne);
        }
      }
      
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/insertionMarqueReussie');
      $this->load->view('templates/PiedDePage');
    }
    else
    {
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/Panier', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
   } // AjouterPanier

   public function ModifierPanier()
   {
    $DonneesInjectees['TitreDeLaPage'] = 'Panier';
    if($this->input->post('btnModifier'))
    {
      $total= $this->cart->total_items();
      for ($i = 1; $i <=$total ; $i++)
      {
        $donneesamodifier=array(
          'rowid'=> $this->input->post($i.'[rowid]'),
          'qty'=> $this->input->post($i.'[qty]')
        );
        $this->cart->update($donneesamodifier);
      }
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/Panier', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  } // ModifierPanier

  public function SupprimerPanier($rowid)
   {
    $DonneesInjectees['TitreDeLaPage'] = 'Panier';
    
    if($this->input->post('btnSupprimer'))
    {
      $this->cart->remove($rowid);
      }
      $this->load->view('templates/Entete');
      $this->load->view('visiteur/Panier', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    } // SupprimerPanier

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
          'PROFIL' => 'user',
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
      $DonneesInjectees['Utilisateur']= $this->ModeleUtilisateur->retournerUtilisateur(array("EMAIL"=> $this->session->identifiant));
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


   public function listerLesArticlesAvecPagination() 
   {
    // les noms des entrées dans $config doivent être respectés
    $config = array();
    $config["base_url"] = site_url('visiteur/listerLesArticlesAvecPagination');
    $config["total_rows"] = $this->ModeleArticle->nombreDArticles();
    $config["per_page"] = 3; // nombre d'articles par page
    $config["uri_segment"] = 3; /* le n° de la page sera placé sur le segment n°3 de URI
    pour la page 4 on aura : visiteur/listerLesArticlesAvecPagination/4   */  
    $config['first_link'] = 'Premier';
    $config['last_link'] = 'Dernier';
    $config['next_link'] = 'Suivant';
    $config['prev_link'] = 'Précédent';
    $this->pagination->initialize($config);
    $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    /* on récupère le n° de la page - segment 3 - si ce segment est vide, cas du premier appel
    de la méthode, on affecte 0 à $noPage */
    $DonneesInjectees['TitreDeLaPage'] = 'Les articles avec pagination';
    $DonneesInjectees["lesArticles"] = $this->ModeleArticle->retournerArticlesLimite($config["per_page"], $noPage);
    $DonneesInjectees["liensPagination"] = $this->pagination->create_links();
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/listerLesArticlesAvecPagination", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
 } // fin listerLesArticlesAvecPagination

}  // Visiteur