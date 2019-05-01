<?php
abstract class Kontroler
{
        protected $data = array();
        protected $pohled = "";
        protected $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');  
    
    // Ošetří proměnnou pro výpis do HTML stránky
	private function osetri($x = null)
	{
		if (!isset($x))
			return null;
		elseif (is_string($x))
			return htmlspecialchars($x, ENT_QUOTES);
		elseif (is_array($x))
		{
			foreach($x as $k => $v)
			{
				$x[$k] = $this->osetri($v);
			}
			return $x;
		}
		else 
			return $x;
	}

    public function vypisPohled()
    {
        if ($this->pohled)
        {
                extract($this->data);
                require("pohledy/" . $this->pohled . ".phtml");
        }
    }
    
    public function pridejZpravu($zprava)
    {
        if (isset($_SESSION['zpravy']))
                $_SESSION['zpravy'][] = $zprava;
        else
                $_SESSION['zpravy'] = array($zprava);
    }
    
    public static function vratZpravy()
    {
        if (isset($_SESSION['zpravy']))
        {
                $zpravy = $_SESSION['zpravy'];
                unset($_SESSION['zpravy']);
                return $zpravy;
        }
        else
                return array();
    }
    
    public function presmeruj($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }    
    
    public function overUzivatele($admin = false)
    {
        $spravceUzivatelu = new SpravceUzivatelu();
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        if (!$uzivatel || ($admin && !$uzivatel['admin']))
        {       $this->pridejZpravu('Nedostatečná oprávnění.');
                $this->presmeruj('prihlaseni');
        }             
    }      

    // Hlavní metoda controlleru
    abstract function zpracuj($parametry);
}
?>
