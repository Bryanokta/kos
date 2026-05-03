<?php
require_once 'controller/PenghuniController.php';

$controller = new PenghuniController();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($action == 'create') {
    $controller->create();
} elseif ($action == 'edit' && $id) {
    $controller->edit($id);
} elseif ($action == 'delete' && $id) {
    $controller->delete($id);
} else {
    $controller->index();
}
