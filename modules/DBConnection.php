<?php

	require_once('config/config.php');

	class DBConnection
	{
		private $dbc;

		public function __construct()
		{
			$conn_str = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.";charset=utf8";
			$db = new PDO($conn_str, DB_USER, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			$this->dbc = $db;
		}
		

		public function getDb()
		{
			return $this->dbc;
		}
	}