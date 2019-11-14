<?php

namespace application\lib;

use PDO;

class Db {

	protected $db;
	
	public function __construct() {
		$config = require 'application/config/db.php';
        try {
            $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
//		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
	}


	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(':'.$key, $val);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

    public function postAdd($post) {
        $params = [
            'id' => '',
            'fio' => $post['fio'],
            'email' => $post['email'],
            'date' => $post['date'],
            'name' => $post['name'],
            'description' => $post['description'],
        ];
        $this->db->query('INSERT INTO tasks VALUES (:id, :fio, :email, :date, :name, :description)', $params);
        return $this->db->lastInsertId();
    }

	public function add($params) {

        $sql = $this->db->prepare("INSERT INTO tasks (`fio`, `email`, `date`, `name`, `description`) VALUES (?, ?, ?, ?, ?)");
        $sql->bindParam(1, $params['fio']);
        $sql->bindParam(2, $params['email']);
        $sql->bindParam(3, $params['date']);
        $sql->bindParam(4, $params['name']);
        $sql->bindParam(5, $params['description']);
        $this->query($sql, $params);
	}


}