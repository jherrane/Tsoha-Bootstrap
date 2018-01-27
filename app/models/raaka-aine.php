<?php
class RaakaAine extends BaseModel{
	public $id, $nimi, $maara;

	public function __construct($attributes){
		parent::__construct($attributes);
	}
	

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM RaakaAine');
		$query->execute();
		$rows = $query->fetchAll();
		$raakaAineet = array();

		foreach($rows as $row){
			$raakaAineet[] = new RaakaAine(array(
				'id' => $row['id'],
				'nimi' => $row['nimi']
			));
		}

		return $raakaAineet;
	}

	public static function findByDrinkki($id){
		$query = DB::connection()->prepare('SELECT RaakaAine.id, RaakaAine.nimi, DrinkkiRaakaAine.maara FROM Drinkki, DrinkkiRaakaAine, RaakaAine WHERE Drinkki.id = :id AND DrinkkiRaakaAine.drinkki_id = Drinkki.id AND RaakaAine.id = DrinkkiRaakaAine.raakaaine_id;');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();
		$raakaAineet = array();

		foreach($rows as $row){
			$raakaAineet[] = new RaakaAine(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'maara' => $row['maara']
			));
		}

		return $raakaAineet;
	}

}