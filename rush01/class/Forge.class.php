<?PHP
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Weapon.class.php');

class Forge
{
    public $_faction;
    public $_weapons = array();

    public function getFac()
    {
        return $this->_faction;
    }

    public function __construct()
    {
    }

    public function addWeaponInventory($kwargs)
    {
        $this->_weapons[] = new Weapon($kwargs);
    }

    public function forgeWeapon($name)
    {
        foreach ($this->_weapons as $arm) {
            if ($name === $arm->get('name')) {
                $kwargs = array('name' => $name,
                                'charges' => $arm->get('_charges'),
                                'sr' => $arm->get('_shortRange'),
                                'mr' => $arm->get('_mediumRange'),
                                'lr' => $arm->get('_longRange'),
                                'shape' => $arm->get('_shape'), );

                return new Weapon($kwargs);
            }
        }

        return false;
    }

    public static function doc()
    {
        echo file_get_contents('Forge.doc.txt');
    }
}
?>