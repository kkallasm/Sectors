<?php

        chdir('../');
	require_once('modules/DBConnection.php');

	$dbc = new DBConnection();


        print "***********  CREATE USERS TABLE ****************\n";

        $sql = "CREATE TABLE users ( 
                id INT NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY (id))";
        $dbc->getDb()->exec($sql);

        print "Users table created \n\n";


        print "***********  CREATE SECTORS TABLE ****************\n";

        $sql = "CREATE TABLE sectors ( 
                id INT NOT NULL AUTO_INCREMENT,
                parent_id INT,
                name VARCHAR(255) NOT NULL,
                level INT NOT NULL,
                PRIMARY KEY (id))";
        $dbc->getDb()->exec($sql);

        print "Sectors table created \n\n";


        print "***********  CREATE USER_SECTORS TABLE ****************\n";

        $sql = "CREATE TABLE user_sectors ( 
                user_id INT NOT NULL,
                sector_id INT NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (sector_id) REFERENCES sectors(id))";
        $dbc->getDb()->exec($sql);

        print "User_sectors table created \n\n";


        print "***********  INSERT DATA TO SECTOR TABLE ****************\n\n";

	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTMLFile('scripts/index.html');

	$parent_id = null;
	$prev_lvl  = 0; 
	$parents = array();
	foreach($doc->getElementsByTagName('option') as $opt) {

        $id    = intval($opt->getAttribute('value'));
        $value = mb_convert_encoding($opt->nodeValue,'HTML-ENTITIES', 'UTF-8');
        $level = intval(substr_count($value,'&nbsp;') / 4);
        $name  = trim(str_replace('&nbsp;','',$value));  

        if($level == 0)
        {
        	$parent_id = $id;
        	$parents = array();
        	$parents[0] = $id;
        }
        else
        {
        	$parents[$level] = $id;
        }

        $prev_lvl = $level;
        $parent_id = ($level == 0)?null:$parents[$level-1];

        //insert into db
        $stmt = $dbc->getDb()->prepare("INSERT INTO sectors VALUES(:id, :parent_id, :name, :level)");
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':parent_id', $parent_id);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':level', $level);
		$stmt->execute();

        print "INSERTED ROW:: ".$id." - ".$name."\n";
}
