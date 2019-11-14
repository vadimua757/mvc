<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

	public function actionIndex() {

		$this->view->render('Главная страница');
	}

    public function actionAdd() {

        if (!empty($_POST)){
            $this->model->postAdd($_POST);

            $message =
                "У Вас пояаилась новая задача\r\n
                Срок - ". $_POST['date']."\r\n
                Описание - ". $_POST['description'];

            $message = wordwrap($message, 70, "\r\n");

            mail($_POST['email'], 'Новая задача', $message);
        }
        exit;

    }
	public function actionJson() {

        if (!empty($_POST)){
            $this->model->postAdd($_POST);
        }
            $pageData = $this->model->getAllrecords(); // data to return

            // output json
            header("Content-type: application/json");
            echo json_encode($pageData);
        // stop
        exit;
	}

	public function actionRemove() {

        if (!empty($_POST)){
            $this->model->postRemove($_POST['id']);
        }
        exit;
	}

}