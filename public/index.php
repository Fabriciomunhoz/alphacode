<?php
require_once '../config.php';
require_once '../app/controllers/ContactController.php';

$db = getDB();
$controller = new ContactController($db);

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $controller->delete($id);
        break;
    default:
        $controller->index();
        break;
}




