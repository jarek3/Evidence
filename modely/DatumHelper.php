<?php
class DatumHelper
 {    
    public static function datumCesky($hodnota)
	{   
        if (!empty($hodnota))
		{
        $datum = new DateTime($hodnota);
		return $datum->format('d.m.Y');
        }
	}
    
    public static function datumDb($hodnota, $format='Y-m-d')
	{   
        //pokud bude zadán měsíc česky textem 
        $mesice = ['ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince'];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];          
        $hodnota= str_replace($mesice, $months, $hodnota);
        //pokud bude datum  zadáno ve tvaru d/m/Y
        $a = explode("/", $hodnota);
        if ($a[0]<32)        
        $hodnota = implode($a, "."); 
        //odstranění případných mezer v zadání datumu
        $hodnota = str_replace(" ", "", $hodnota); 
        $datum = new DateTime($hodnota);         
        return $datum->format('Y-m-d');                
	} 
}                
