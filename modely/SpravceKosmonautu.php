<?php

// Třída poskytuje metody pro správu kosmonautú v jejich evidenci
class SpravceKosmonautu
{
         
        // Vrátí kosmonauta z databáze podle jeho id
        public function vratKosmonauta($kosmonaut_id)
        {
            return Db::dotazJeden('
                SELECT `kosmonaut_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `superschopnost`
                FROM `kosmonauti`
                WHERE `kosmonaut_id` = ?
                ', array($kosmonaut_id));
        }

        // Vrátí seznam kosmonautů v databázi
        public function vratKosmonauty()
        {
            return Db::dotazVsechny('
                SELECT `kosmonaut_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `superschopnost`
                FROM `kosmonauti`
                ORDER BY `kosmonaut_id` DESC
                ');
        }
        
        public function ulozKosmonauta($kosmonaut_id, $kosmonaut)
        {    
            if (!$kosmonaut_id)
                Db::vloz('kosmonauti', $kosmonaut);
            else
                Db::zmen('kosmonauti', $kosmonaut, 'WHERE `kosmonaut_id` = ?', array($kosmonaut_id));
        }

        public function odstranKosmonauta($kosmonaut_id)
        {
            Db::dotaz('
                DELETE FROM `kosmonauti`
                WHERE `kosmonaut_id` = ?
            ', array($kosmonaut_id));
        }
}
