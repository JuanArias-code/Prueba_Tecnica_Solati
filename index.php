<?php
require_once 'controllers/UserController.php';
require_once 'config/config.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$controller = new UserController();

try {
    switch ($action) {
        case 'getUsers':
            $controller->getUsers();
            break;
        case 'createUser':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                if (isset($data['contact_email'], $data['first_name'], $data['last_name'], $data['membership_type'], $data['password'])) {
                    $controller->createUser($data['contact_email'], $data['first_name'], $data['last_name'], $data['membership_type'], $data['password']);
                } else {
                    header('Content-Type: application/json', true, 400);
                    echo json_encode(['error' => 'Invalid input data']);
                }
            } else {
                header('Content-Type: application/json', true, 405);
                echo json_encode(['error' => 'Method Not Allowed']);
            }
            break;
        case 'findOneUser':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $controller->getUserById($id);
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['error' => 'Valid ID is required']);
            }
            break;
        case 'updateUser':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                if (isset($data['id'], $data['contact_email'], $data['first_name'], $data['last_name'], $data['membership_type'])) {
                    $controller->updateUser($data['id'], $data['contact_email'], $data['first_name'], $data['last_name'], $data['membership_type'], isset($data['password']) ? $data['password'] : null);
                } else {
                    header('Content-Type: application/json', true, 400);
                    echo json_encode(['error' => 'Invalid input data']);
                }
            } else {
                header('Content-Type: application/json', true, 405);
                echo json_encode(['error' => 'Method Not Allowed']);
            }
            break;
        case 'deleteUser':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                if (isset($data['id']) && is_numeric($data['id'])) {
                    $controller->deleteUser($data['id']);
                } else {
                    header('Content-Type: application/json', true, 400);
                    echo json_encode(['error' => 'User ID is required']);
                }
            } else {
                header('Content-Type: application/json', true, 405);
                echo json_encode(['error' => 'Method Not Allowed']);
            }
            break;
        default:
            require 'views/form_api.php';
            break;
    }
} catch (Exception $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode(['error' => 'Internal Server Error', 'message' => $e->getMessage()]);
}
