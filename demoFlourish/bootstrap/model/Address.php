<?php
class Address extends fActiveRecord
{

    protected function configure()
    {
		fORMDate::configureDateCreatedColumn($this, 'created_at');
		fORMDate::configureDateUpdatedColumn($this, 'updated_at');
    }

	public static function getAll($where_conditions=array(), $order_bys=array())
    {
		return fRecordSet::build(
			__CLASS__,
			$where_conditions,
			$order_bys
		);
	}

	public static function getObject($where_conditions=array(), $order_bys=array())
    {
		$record = fRecordSet::build(
			__CLASS__,
			$where_conditions,
			$order_bys
		);
		return ($record->count() > 0) ? $record->getRecord(0) : false;
	}

	public static function getAllFromSQL($where_conditions=array(), $order_bys=array(), $limit=array(0,0), $page=1)
    {
		$where = "";
        $orderBy = "";
		$start = (isset($limit[0])) ? $limit[0] : 0;
        $limit = (isset($limit[1])) ? $limit[1] : 0;
		$total_where_conditions = count($where_conditions);
		$total_order_bys = count($order_bys);

        if ($total_where_conditions > 0) {
            $where .= "WHERE ";
            $i = 1;
            foreach ($where_conditions as $key => $where_condition) {
                $where .= "$key $where_condition";
                if ($i < $total_where_conditions) $where .= " AND ";
                $i++;
            }
        }
        if ($total_order_bys > 0) {
            $orderBy .= "ORDER BY ";
            $i = 1;
            foreach ($order_bys as $key => $order_by) {
                $orderBy .= "$key $order_by";
                if ($i < $total_order_bys) $orderBy .= ", ";
                $i++;
            }
        }

		if ($limit > 0) {
			return fRecordSet::buildFromSQL(
				__CLASS__,
				"SELECT * FROM " . fORM::tablize(__CLASS__) . " $where $orderBy LIMIT $start, $limit",
				"SELECT count(*) FROM " . fORM::tablize(__CLASS__) . " $where",
				$limit, // $limit
				$page  // $page
			);
		} else {
			return fRecordSet::buildFromSQL(
				__CLASS__,
				"SELECT * FROM " . fORM::tablize(__CLASS__) . " $where $orderBy",
				"SELECT count(*) FROM " . fORM::tablize(__CLASS__) . " $where"
			);
		}
	}

	public static function getObjectFromSQL($where_conditions=array(), $order_bys=array())
    {
		$where = "";
		$orderBy = "";
		$total_where_conditions = count($where_conditions);
		$total_order_bys = count($order_bys);

        if ($total_where_conditions > 0) {
            $where .= "WHERE ";
            $i = 1;
            foreach ($where_conditions as $key => $where_condition) {
                $where .= "$key $where_condition";
                if ($i < $total_where_conditions) $where .= " AND ";
                $i++;
            }
        }
		 if ($total_order_bys > 0) {
            $orderBy .= "ORDER BY ";
            $i = 1;
            foreach ($order_bys as $key => $order_by) {
                $orderBy .= "$key $order_by";
                if ($i < $total_order_bys) $orderBy .= ", ";
                $i++;
            }
        }

		$record = fRecordSet::buildFromSQL(
			__CLASS__,
			"SELECT * FROM " . fORM::tablize(__CLASS__) . " $where $orderBy"
		);
		return ($record->count() > 0) ? $record->getRecord(0) : false;
	}

	public static function getCount($where_conditions=array())
    {
		$where = "";
		$total_where_conditions = count($where_conditions);

        if ($total_where_conditions > 0) {
            $where .= "WHERE ";
            $i = 1;
            foreach ($where_conditions as $key => $where_condition) {
                $where .= "$key $where_condition";
                if ($i < $total_where_conditions) $where .= " AND ";
                $i++;
            }
        }

		return fORMDatabase::retrieve()->query("SELECT count(*) FROM " . fORM::tablize(__CLASS__) . " $where")->fetchScalar();
	}

}
?>
