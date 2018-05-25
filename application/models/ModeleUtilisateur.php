<?php
class ModeleUtilisateur extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    } // __construct 

    public function existe($pUtilisateur) // non utilisée retour 1 si connecté, 0 sinon
    {  
        $this->db->where($pUtilisateur);
        $this->db->from('client');
        return $this->db->count_all_results(); // nombre de ligne retournées par la requeête
    } // existe

    public function retournerUtilisateur($pUtilisateur)
    {
        $requete = $this->db->get_where('client',$pUtilisateur);
        return $requete->row(); // retour d'une seule ligne !
        // retour sous forme d'objets
        
    } // retournerUtilisateur

    public function ModificationUnCompte($pDonneesAInserer, $id)
     {
        $this->db->where('EMAIL', $id);
        return $this->db->update('client', $pDonneesAInserer);
     } // ModifierUnCompte
} // Fin Classe