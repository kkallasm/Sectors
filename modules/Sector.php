<?php

	require_once('modules/DBConnection.php');

	class Sector
	{

		private static function constructSectors($target,$parent_sectors,&$data)
		{
			foreach($target as $k =>$v)
			{
				$data[] = $v;
				if(isset($parent_sectors[$k]))
					self::constructSectors($parent_sectors[$k],$parent_sectors,$data);
			}			
		}

		public static function getSectors()
		{
		    $dbc = new DBConnection();

			$sectors  = array();
			$selected = array();

			$query = $dbc->getDb()->prepare("SELECT * FROM sectors ORDER BY level, name");
			$query->execute();

			if ($query->rowCount() > 0)
			{
				$root_sectors 	= array();
				$parent_sectors = array();
    			$res = $query->fetchAll(PDO::FETCH_ASSOC);
    			foreach($res as $row)
    			{
    				if($row['level'] == 0)
    					$root_sectors[$row['id']] = $row;	
    				else
    				    $parent_sectors[$row['parent_id']][$row['id']] = $row;				
    			}

    			self::constructSectors($root_sectors,$parent_sectors,$sectors);

			}

			return $sectors;
		}
	}