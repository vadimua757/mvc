<?php

namespace application\models;

use application\core\Model;

class Main extends Model {


    public function getAllRecords()
    {
        return $this->db->row('SELECT * FROM tasks');

    }
    public function getCount()
    {
        return $this->db->column('SELECT COUNT(*) FROM tasks');

    }

    public function postAdd($post) {

        $params = [
            'id' => '',
            'fio' => $post['fio'],
            'email' => $post['email'],
            'date' => $post['date'],
            'dateadd' => date('Y-m-d H:i:s'),
            'name' => $post['name'],
            'description' => $post['description'],
        ];
        $this->db->query('INSERT INTO tasks VALUES (:id, :fio, :email, :date, :dateadd, :name, :description)', $params);
    }

    public function postRemove($id) {
        $this->db->query('DELETE FROM tasks WHERE `id` = ' . $id);
    }
}