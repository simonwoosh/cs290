<?php #class orders
class orders {

	//returns an array of order objects
	public static function getAll() {
		$query = db::query("SELECT id FROM order");
		$orderArray = array();
		foreach($query as $orderRow) {
			if ($orderRow['id']>0){
				$orderArray[] = new order($orderRow['id']);
			}
		}
		return $orderArray;
	}
}