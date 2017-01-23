<?PHP

require_once($_SERVER['DOCUMENT_ROOT'].'/class/Forge.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Weapon.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Shipyard.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/class/Fleet.class.php');

$weapons = array(
array('name' => 'Batteries laser de flancs', 'shape' => 'trapez', 'sr' => 10, 'mr' => 20, 'lr' => 30, 'charges' => 0, 'faction' => 'Space Marine'),
array('name' => 'Lance navale', 'shape' => 'line', 'sr' => 30, 'mr' => 60, 'lr' => 90, 'charges' => 0, 'faction' => 'Space Marine'),
array('name' => 'Lance navale lourde', 'shape' => 'line', 'sr' => 30, 'mr' => 60, 'lr' => 90, 'charges' => 3, 'faction' => 'Space Marine'),
array('name' => 'Mitrailleuses super lourde de proximité', 'shape' => 'circle', 'sr' => 3, 'mr' => 7, 'lr' => 10, 'charges' => 5, 'faction' => 'Space Marine'),
array('name' => 'Macro canon', 'shape' => 'oval', 'sr' => 10, 'mr' => 20, 'lr' => 30, 'charges' => 0, 'faction' => 'Space Marine'),
array('name' => "Kanon'eud la mort", 'shape' => 'trapez', 'sr' => 5, 'mr' => 15, 'lr' => 25, 'charges' => 2, 'faction' => 'Ork'),
array('name' => 'Canon Zap', 'shape' => 'circle', 'sr' => 5, 'mr' => 10, 'lr' => 15, 'charges' => 2, 'faction' => 'Ork'),
array('name' => 'Lance Rokette', 'shape' => 'oval', 'sr' => 10, 'mr' => 20, 'lr' => 30, 'charges' => 0, 'faction' => 'Ork'),
array('name' => 'Gro Baton', 'shape' => 'line', 'sr' => 30, 'mr' => 60, 'lr' => 90, 'charges' => 2, 'faction' => 'Ork'),
array('name' => 'Mega Kalibr', 'shape' => 'rect', 'sr' => 7, 'mr' => 14, 'lr' => 21, 'charges' => 3, 'faction' => 'Ork'),
array('name' => 'Lance Stellaire', 'shape' => 'line', 'sr' => 35, 'mr' => 65, 'lr' => 95, 'charges' => 0, 'faction' => 'Eldar'),
array('name' => 'Rayonneur Laser', 'shape' => 'trapez', 'sr' => 7, 'mr' => 14, 'lr' => 21, 'charges' => 0, 'faction' => 'Eldar'),
array('name' => 'Canon Prisme', 'shape' => 'circle', 'sr' => 3, 'mr' => 7, 'lr' => 10, 'charges' => 3, 'faction' => 'Eldar'),
array('name' => 'Canon Hurleur', 'shape' => 'rect', 'sr' => 20, 'mr' => 30, 'lr' => 40, 'charges' => 0,  'faction' => 'Eldar'),
array('name' => 'Lance Apocalypse', 'shape' => 'line', 'sr' => 35, 'mr' => 65, 'lr' => 95, 'charges' => 4, 'faction' => 'Eldar'), );

$faction = array('Ork', 'Eldar', 'Space Marine');

$forge = new Forge();

foreach ($weapons as $w) {
            $forge->addWeaponInventory($w);
}

foreach($weapons as $elem) {
    if ($elem['faction'] == 'Space Marine')
        $tab_weapon_marine[] = $elem['name'];
    else if ($elem['faction'] == 'Ork')
        $tab_weapon_ork[] = $elem['name'];
    else
        $tab_weapon_eldar[] = $elem['name'];
}

$rand = 0;
while ($rand < 4) {
    $index = rand(0,4);
    $ship_marine[] = $tab_weapon_marine[$index];
    $rand += 1;
}

$rand = 0;
while ($rand < 4) {
    $index = rand(0,4);
    $ship_ork[] = $tab_weapon_ork[$index];
    $rand += 1;
}

$rand = 0;
while ($rand < 4) {
    $index = rand(0,4);
    $ship_eldar[] = $tab_weapon_eldar[$index];
    $rand += 1;
}

$ship = array(
array('name' => 'Honorable Duty', 'height' => '1', 'width' => '4', 'hp' => '10', 'pp' => '5' , 'speed' => '15', 'manoeuvre' => '4', 'shield' => '0', 'faction' => 'Space Marine', 'weapon' => $ship_marine[0], 'weight' => 3),
array('name' => 'Sword Of Absolution', 'height' => '1', 'width' => '3', 'hp' => '4', 'pp' => '10' , 'speed' => '18', 'manoeuvre' => '3', 'shield' => '0', 'faction' => 'Space Marine', 'weapon' => $ship_marine[1], 'weight' => 2),
array('name' => 'Hand Of The Emperor', 'height' => '1', 'width' => '4', 'hp' => '5', 'pp' => '10' , 'speed' => '15', 'manoeuvre' => '4', 'shield' => '0', 'faction' => 'Space Marine', 'weapon' => $ship_marine[2], 'weight' => 1),
array('name' => 'Imperator Deus', 'height' => '2', 'width' => '7', 'hp' => '8', 'pp' => '12' , 'speed' => '10', 'manoeuvre' => '5', 'shield' => '2', 'faction' => 'Space Marine', 'weapon' => $ship_marine[3], 'weight' => 4),
array('name' => 'Honored Feast', 'height' => '1', 'width' => '4', 'hp' => '10', 'pp' => '5' , 'speed' => '15', 'manoeuvre' => '4', 'shield' => '0', 'faction' => 'Ork', 'weapon' => $ship_ork[0], 'weight' => 3),
array('name' => 'Moonfield', 'height' => '1', 'width' => '3', 'hp' => '4', 'pp' => '10' , 'speed' => '18', 'manoeuvre' => '3', 'shield' => '0', 'faction' => 'Ork', 'weapon' => $ship_ork[1], 'weight' => 2),
array('name' => 'Monsters of Hope', 'height' => '1', 'width' => '4', 'hp' => '5', 'pp' => '10' , 'speed' => '15', 'manoeuvre' => '4', 'shield' => '0', 'faction' => 'Ork', 'weapon' => $ship_ork[2], 'weight' => 1),
array('name' => 'Firewell', 'height' => '2', 'width' => '7', 'hp' => '8', 'pp' => '12' , 'speed' => '10', 'manoeuvre' => '5', 'shield' => '2', 'faction' => 'Ork', 'weapon' => $ship_ork[3], 'weight' => 4),
array('name' => 'Kylrad Cruel', 'height' => '1', 'width' => '4', 'hp' => '10', 'pp' => '5' , 'speed' => '15', 'manoeuvre' => '4', 'shield' => '0', 'faction' => 'Eldar', 'weapon' => $ship_eldar[0], 'weight' => 3),
array('name' => 'Zenobe Coldheart', 'height' => '1', 'width' => '3', 'hp' => '4', 'pp' => '10' , 'speed' => '18', 'manoeuvre' => '3', 'shield' => '0', 'faction' => 'Eldar', 'weapon' => $ship_eldar[1], 'weight' => 2),
array('name' => 'Lidorn Acid', 'height' => '1', 'width' => '4', 'hp' => '5', 'pp' => '10' , 'speed' => '15', 'manoeuvre' => '4', 'shield' => '0', 'faction' => 'Eldar', 'weapon' => $ship_eldar[2], 'weight' => 1),
array('name' => 'Bydern Deadly', 'height' => '2', 'width' => '7', 'hp' => '8', 'pp' => '12' , 'speed' => '10', 'manoeuvre' => '5', 'shield' => '2', 'faction' => 'Eldar', 'weapon' => $ship_eldar[3], 'weight' => 4),
);
$shipyard = new Shipyard($forge);
foreach($ship as $line)
{
    $shipyard->addBluePrint($line);
}

function presset($faction, $tailleflotte, $tailleship, $ship) {
    $presset = array();
    $toto = 0;
    $i = 0;
    $toreturn = array();
    if ($tailleflotte == 'LIT')
        $toto = 500;
    else if ($tailleflotte == 'AVG')
        $toto = 1000;
    else if ($tailleflotte == 'BIG')
        $toto = 1500;
        
    foreach ($ship as $e) {
        if ($e['faction'] == $faction) {
            if ($tailleship == 'HW' && $e['weight'] == 3) {
                while ($i <= $toto) {
                    $presset[] = $e;
                    $i += 400;
                }
            }
            else if ($tailleship == 'MW' && $e['weight'] == 2) {
                while ($i <= $toto) {
                    $presset[] = $e;
                    $i += 200;
                }
            }
            else if ($tailleship == 'LW' && $e['weight'] == 1) {
                while ($i <= $toto) {
                    $presset[] = $e;
                    $i += 100;
                }
            }
        }
    }
    $toreturn['name'] = $tailleflotte . $tailleship;
    $toreturn['faction'] = $faction;
    foreach($presset as $e) {
        $toreturn['shipname'][] = $e['name'];
    }
    return $toreturn;
}
$all_presset = array();
$all_presset[] = presset('Space Marine', 'BIG', 'LW', $ship);
$all_presset[] = presset('Space Marine', 'BIG', 'MW', $ship);
$all_presset[] = presset('Space Marine', 'BIG', 'HW', $ship);

$all_presset[] = presset('Space Marine', 'AVG', 'LW', $ship);
$all_presset[] = presset('Space Marine', 'AVG', 'MW', $ship);
$all_presset[] = presset('Space Marine', 'AVG', 'HW', $ship);

$all_presset[] = presset('Space Marine', 'LIT', 'LW', $ship);
$all_presset[] = presset('Space Marine', 'LIT', 'MW', $ship);
$all_presset[] = presset('Space Marine', 'LIT', 'HW', $ship);

$all_presset[] = presset('Ork', 'BIG', 'LW', $ship);
$all_presset[] = presset('Ork', 'BIG', 'MW', $ship);
$all_presset[] = presset('Ork', 'BIG', 'HW', $ship);

$all_presset[] = presset('Ork', 'AVG', 'LW', $ship);
$all_presset[] = presset('Ork', 'AVG', 'MW', $ship);
$all_presset[] = presset('Ork', 'AVG', 'HW', $ship);

$all_presset[] = presset('Ork', 'LIT', 'LW', $ship);
$all_presset[] = presset('Ork', 'LIT', 'MW', $ship);
$all_presset[] = presset('Ork', 'LIT', 'HW', $ship);

$all_presset[] = presset('Eldar', 'BIG', 'LW', $ship);
$all_presset[] = presset('Eldar', 'BIG', 'MW', $ship);
$all_presset[] = presset('Eldar', 'BIG', 'HW', $ship);

$all_presset[] = presset('Eldar', 'AVG', 'LW', $ship);
$all_presset[] = presset('Eldar', 'AVG', 'MW', $ship);
$all_presset[] = presset('Eldar', 'AVG', 'HW', $ship);

$all_presset[] = presset('Eldar', 'LIT', 'LW', $ship);
$all_presset[] = presset('Eldar', 'LIT', 'MW', $ship);
$all_presset[] = presset('Eldar', 'LIT', 'HW', $ship);

$fleetbuilder = new Fleet(array('forge' => $forge, 'shipyard' => $shipyard));
foreach ($all_presset as $set)
{
    $fleetbuilder->addFleet($set);
}
$str = serialize($fleetbuilder);
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/data/fleetbuilder', $str);
?>