<?php
require_once '../app/models/Contact.php';

class ContactController {
    private $model;
    public function __construct($db) {
        $this->model = new Contact($db);
    }
    public function index() {
        $contacts = $this->model->getAllContacts();
        require '../app/views/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->addContact($_POST);
            header('Location: index.php');
            exit();
        } else {
            require '../app/views/create.php';
        }
    }
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'nome_completo' => $_POST['nome_completo'],
                'data_nascimento' => $_POST['data_nascimento'],
                'email' => $_POST['email'],
                'profissao' => $_POST['profissao'],
                'telefone' => $_POST['telefone'],
                'celular' => $_POST['celular'],
                'celular_possui_whatsapp' => isset($_POST['celular_possui_whatsapp']) ? 1 : 0,
                'notificacao_email' => isset($_POST['notificacao_email']) ? 1 : 0,
                'notificacao_sms' => isset($_POST['notificacao_sms']) ? 1 : 0
            ];
            if ($this->model->updateContact($data)) {
                header('Location: index.php');
                exit();
            } else {
                echo 'Erro ao atualizar o contato.';
            }
        } else {
            header('Location: index.php');
            exit();
        }
    }
    public function getContactById() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $data = $this->model->getContactById($id);
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID não fornecido para atualização.']);
        }
    }
    public function delete($id) {
        if (is_numeric($id)) {
            $this->model->deleteContact($id);
            header('Location: index.php');
            exit();
        } else {
            echo 'ID inválido para exclusão.';
        }
    }
}

