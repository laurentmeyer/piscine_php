<?PHP

class Weapon
{
    private $_name;
    private $_charges;
    private $_shortRange;
    private $_mediumRange;
    private $_longRange;
    private $_shape;

    public function get($attr)
    {
        return $this->$attr;
    }

    public function __construct(array $kwargs)
    {
        $this->_name = $kwargs['name'];
        $this->_charges = $kwargs['charges'];
        $this->_shortRange = $kwargs['sr'];
        $this->_mediumRange = $kwargs['mr'];
        $this->_longRange = $kwargs['lr'];
        $this->_shape = $kwargs['shape'];
    }

    public function generateShot($PP)
    {
        $de = 0;
        for ($x = 0; $x < ($PP + $this->_charges); $x += 1) 
        {
            $de = max($de, rand(1, 6));
        }
        $out = array('shape' => $this->_shape);
        $out['range'] = ($de < 4) ? 0 : (($de == 4) ? $this->_shortRange : (($de == 5) ? $this->_mediumRange : $this->_longRange));

        return $out;
    }

    public function arrayify()
    {
        return  array(
            'name' => $this->_name,
            'charges' => $this->_charges,
            'shortRange' => $this->_shortRange,
            'mediumRange' => $this->_mediumRange,
            'longRange' => $this->_longRange,
            'shape' => $this->_shape, );
    }

    public static function doc()
    {
        echo file_get_contents('Weapon.doc.txt');
    }
    public function toArray()
    {
        return  array(
            'name' => $this->_name,
            'charges' => $this->_charges,
            'sr' => $this->_shortRange,
            'mr' => $this->_mediumRange,
            'lr' => $this->_longRange,
            'shape' => $this->_shape, );
        
    }
}
