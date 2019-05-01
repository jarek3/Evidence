<?php
class KosmonautKontroler extends Kontroler
{
        public function zpracuj($parametry)
        {
                // Vytvoření instance modelu, který nám umožní pracovat s kosmonauty
                $spravceKosmonautu = new SpravceKosmonautu();
                $spravceUzivatelu = new SpravceUzivatelu();                                 
                $uzivatel = $spravceUzivatelu->vratUzivatele();
                $this->data['admin'] = $uzivatel && $uzivatel['admin'];
                
                // Je zadán kosmonaut ke smazání
        if (!empty($parametry[1]) && $parametry[1] == 'odstranit')
        {
                $this->overUzivatele(true);
                $spravceKosmonautu->odstranKosmonauta($parametry[0]);
                $this->pridejZpravu('Kosmonaut byl úspěšně odstraněn');
                $this->presmeruj('kosmonaut');
        }                
                
                // Je zadán kosmonaut
        if (!empty($parametry[0]))
            {
                // Získání kosmonauta
                $kosmonaut = $spravceKosmonautu->vratKosmonauta($parametry[0]);
                // Pokud nebyl kosmonaut nalezen, přesměrujeme na ChybaKontroler
                if (!$kosmonaut)
                        $this->presmeruj('chyba'); 
                
                // Naplnění proměnných pro šablonu 
                $this->data['jmeno'] = $kosmonaut['jmeno'];
                $this->data['prijmeni'] = $kosmonaut['prijmeni'];
                $this->data['datum_narozeni'] = DatumHelper::datumCesky($kosmonaut['datum_narozeni']);
                $this->data['superschopnost'] = $kosmonaut['superschopnost'];
               
                // Nastavení šablony
                $this->pohled = 'kosmonaut';
            }
        else
        // Není zadán kosmonaut, vypíšeme všechny
            {
                $kosmonauti = $spravceKosmonautu->vratKosmonauty();
                $this->data['kosmonauti'] = $kosmonauti;
                $this->pohled = 'kosmonaut';
            }
        }    
}
