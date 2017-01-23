<?PHP
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Forge.class.php');

class Shipyard
{
    private $_forge;
    private $_ships = array();
    
    public function __construct($forge)
    {
        $this->_forge = $forge;
    }
    
    public function addBluePrint($kwargs)
    {
        $forge = $this->_forge;
        $kwargs['vertical'] = $kwargs['height'];
        $kwargs['horizontal'] = $kwargs['width'];
        foreach ($kwargs['weapon'] as $w)
        {
            $weapons = $forge->forgeWeapon($w);
            $kwargs['weapons'] = $weapons;
            $this->_ships[] = new Battleship($kwargs);
        }
    }
    public function buildShip($name)
    {
        foreach ($this->_ships as $ship)
        {
            if ($name === $ship->getName())
            {
                $out = new Battleship($ship->arrayify());
            }
        }
    }
    public static function doc() {
        echo file_get_contents("Shipyard.doc.txt");
    }

}
?>