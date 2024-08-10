<?php
require_once 'models/UserDAO.php';

class UserController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function getUsers()
    {
        try {
            $users = $this->userDAO->getAllUsers();
            header('Content-Type: application/json');
            header('X-Content-Type-Options: nosniff');
            echo json_encode($users);
        } catch (Exception $e) {
            error_log($e->getMessage());
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    public function getUserById($id)
    {
        try {
            $user = $this->userDAO->getUserById($id);
            header('Content-Type: application/json');
            header('X-Content-Type-Options: nosniff');
            if ($user) {
                echo json_encode($user);
            } else {
                echo json_encode(['error' => 'User not found']);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    public function createUser($contact_email, $first_name, $last_name, $membership_type, $password)
    {
        try {
            if ($this->isValidEmail($contact_email) && $this->isValidPassword($password) && !$this->userDAO->getUserByEmail($contact_email)) {
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $user = $this->userDAO->createUser($contact_email, $first_name, $last_name, $membership_type, $hashedPass);
                header('Content-Type: application/json');
                header('X-Content-Type-Options: nosniff');
                echo json_encode(['success' => $user]);
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['error' => 'Invalid input or user already exists']);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    public function updateUser($id, $contact_email, $first_name, $last_name, $membership_type, $password = null)
    {
        try {
            if ($this->isValidEmail($contact_email) && (!$password || $this->isValidPassword($password))) {
                $hashedPass = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
                $user = $this->userDAO->updateUser($id, $contact_email, $first_name, $last_name, $membership_type, $hashedPass);
                header('Content-Type: application/json');
                header('X-Content-Type-Options: nosniff');
                echo json_encode(['success' => $user]);
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['error' => 'Invalid input']);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this->userDAO->deleteUser($id);
            header('Content-Type: application/json');
            header('X-Content-Type-Options: nosniff');
            echo json_encode(['deleted' => $user]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    private function isValidEmail($contact_email)
    {
        return filter_var($contact_email, FILTER_VALIDATE_EMAIL);
    }

    private function isValidPassword($password)
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?=.*\d)[A-Za-z\d\W]{8,16}$/', $password);
    }
}
?>
