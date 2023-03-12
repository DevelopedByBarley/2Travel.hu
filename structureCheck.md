$files = array(
  'field1' => array('value1', 'value2', 'value3'),
  'field2' => array('value4', 'value5', 'value6'),
);

$ret = array_reduce($files, function($result, $item) {
    foreach ($item as $key => $value) {
        $result[$key][] = $value;
    }
    return $result;
}, array());

Ezt függvényt el tudnád nekem kicsit jobban magyarázni?
Természetesen, szívesen segítek!

Az array_reduce() függvény egy olyan beépített függvény a PHP-ban, amely a tömb elemein végighaladva összevonja őket egyetlen értékbe, és visszaadja ezt az értéket. Ez az összevonás a megadott "callback" függvény segítségével történik.

A fenti példában az array_reduce() függvény egy asszociatív tömböt kap paraméterként, amelynek kulcsai a mezőnevek, és az értékei tömbök, amelyek az adott mezőhöz tartozó értékeket tartalmazzák. A visszatérő érték pedig egy tömb, amely az összes mezőhöz tartozó értékeket tartalmazza.

A callback függvénynek két paramétere van: a $result és az $item. A $result változó az a tömb, amely az előző iteráció eredménye volt, vagy a callback függvény első hívásakor az üres tömb. Az $item változó pedig az aktuális iterációban feldolgozott elem.

A callback függvényben a foreach ciklus segítségével végighaladunk az $item tömbön, és az egyes kulcs-érték párokat hozzáadjuk a $result tömbhöz. Az $item tömb kulcsai azonosak az összes tömbnél, és az értékek eltérnek, így a feldolgozás során az egyes kulcsokhoz tartozó értékeket összevonjuk a $result tömbben.

A függvény visszatérési értéke a $result tömb, amely az összes mezőhöz tartozó értékeket tartalmazza.

Remélem, segítettem tisztázni a függvény működését. Ha bármilyen kérdésed van, nyugodtan írj!