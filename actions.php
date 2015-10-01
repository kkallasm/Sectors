<?php

	ob_start();
	session_start();
	require_once('modules/DBConnection.php');

	//save data
	if($_REQUEST['save'])
	{
		if($_REQUEST['name'] && $_REQUEST['terms'] && $_REQUEST['sectors'] && is_array($_REQUEST['sectors']))
		{
			$dbc = new DBConnection();
			$name = $_REQUEST['name'];

			//update user and data
			if(isset($_SESSION['user_id']) && intval($_SESSION['user_id']))
			{
				$user_id = $_SESSION['user_id'];
				$query = $dbc->getDb()->prepare("UPDATE users SET name = :name WHERE id = :user_id");
				$query->bindValue(':name', $name);
				$query->bindValue(':user_id', $user_id);
				$query->execute();

				//delete from user_sectors and add new ones
				$query = $dbc->getDb()->prepare("DELETE FROM user_sectors WHERE user_id = :user_id");
				$query->bindValue(':user_id', $user_id);
				$query->execute();

				foreach($_REQUEST['sectors'] as $sector_id)
				{
					$query = $dbc->getDb()->prepare("INSERT INTO user_sectors VALUES(:user_id, :sector_id)");
					$query->bindValue(':user_id', $user_id);
					$query->bindValue(':sector_id', $sector_id);
					$query->execute();
				}

				$_SESSION['user_name'] = $name;
				$_SESSION['sectors']   = $_REQUEST['sectors'];
			}
			//insert new user
			else
			{
				$query = $dbc->getDb()->prepare("INSERT INTO users(name) VALUES(:name)");
				$query->bindValue(':name', $name);
				$query->execute();
				$user_id = $dbc->getDb()->lastInsertId();

				foreach($_REQUEST['sectors'] as $sector_id)
				{
					$query = $dbc->getDb()->prepare("INSERT INTO user_sectors VALUES(:user_id, :sector_id)");
					$query->bindValue(':user_id', $user_id);
					$query->bindValue(':sector_id', $sector_id);
					$query->execute();
				}

				//save to session
				$_SESSION['user_id']   = $user_id;
				$_SESSION['user_name'] = $name;
				$_SESSION['sectors']   = $_REQUEST['sectors'];

			}
			header("Location: index.php");
		}

	}
	else header("Location: index.php");