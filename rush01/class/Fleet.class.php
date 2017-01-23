<?PHP

class Fleet
{
    private $_forge;
    private $_shipyard;
    private $_sets = array();
    
    public function __construct($kwargs)
    {
        $this->_forge = $kwargs['forge'];
        $this->_shipyard = $kwargs['shipyard'];
    }
    
    public function addFleet($kwargs)
    {
        $this->_sets[] = array($kwargs['name'], $kwargs['ships'], $kwargs['faction']);
    }
    public function makeDaFleetGreatAgain($name, $faction)
    {
        foreach($this->_sets as $set)
        {
            if ($name == $set['name'] && $faction == $set['faction'])
            {
                $out = array();
                foreach($set['ships'] as $ship)
                {
                    $smith = $this->_shipyard();
                    $out[] = $smith->buildShip($ship);
                }
                return $out;
            }
        }
    }
    public static function doc() {
        echo file_get_contents("Fleet.doc.txt");
    }
}
?>