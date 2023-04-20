<?php 

namespace app\model;

class Database
{
	private static \PDO|null $conn;

	public static function getInstance()
	{
		if(!isset(self::$conn))
		{
			self::$conn = new \PDO("mysql:host=localhost;dbname=udemy_loja_online",'root','');
		}

		return self::$conn;
	}
}