<?php
class EditaceKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {           
                $this->overUzivatele(true);
                // Hlavička stránky
                $this->hlavicka['titulek'] = 'Editace kosmonautů';
                // Vytvoření instance modelu
                $spravceKosmonautu = new SpravceKosmonautu();
                // Příprava prázdného kosmonauta                   
                $kosmonaut = array(
                        'kosmonaut_id' => '',
                        'jmeno' => '',
                        'prijmeni' => '',
                        'datum_narozeni' => '',
                        'superschopnost' => '',                         
                );
                    
                // Je odeslán formulář
                if ($_POST)
                {        
                        // Získání kosmonauta z $_POST
                        $klice = array('jmeno', 'prijmeni', 'datum_narozeni', 'superschopnost');
                        $kosmonaut = array_intersect_key($_POST, array_flip($klice));                         
                        $kosmonaut['datum_narozeni']=DatumHelper::datumDb($kosmonaut['datum_narozeni']); 
                        // Uložení kosmonauta do DB
                        $spravceKosmonautu->ulozKosmonauta($_POST['kosmonaut_id'], $kosmonaut);
                        $this->pridejZpravu('Kosmonaut byl úspěšně uložen.');
                        $this->presmeruj('kosmonaut');
                }
                // Je zadaný kosmonaut k editaci
                else if (!empty($parametry[0]))
                {       
                        $nactenyKosmonaut = $spravceKosmonautu->vratKosmonauta($parametry[0]);
                        if ($nactenyKosmonaut)
                                $kosmonaut = $nactenyKosmonaut;
                        else
                                $this->pridejZpravu('Kosmonaut nebyl nalezen');   
                }                                                               
                 
                $this->data['kosmonaut'] = $kosmonaut;
                $this->pohled = 'editace';
    }
} 
