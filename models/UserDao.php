<?php
require_once 'Database.php';
require_once 'User.php';

class UserDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllUsers()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM member_user");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $users = [];
            foreach ($result as $row) {
                $users[] = [
                    'id' => $row['id'],
                    'contact_email' => $row['contact_email'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'membership_type' => $row['membership_type']
                ];
            }
            return $users;
        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            return []; 
        }
    }

    public function getUserById($id)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM member_user WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return [
                    'id' => $row['id'],
                    'contact_email' => $row['contact_email'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'membership_type' => $row['membership_type']
                ];
            }
            return null; 
        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            return null; 
        }
    }

    public function getUserByEmail($contact_email)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM member_user WHERE contact_email = :contact_email');
            $stmt->bindParam(':contact_email', $contact_email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return [
                    'id' => $row['id'],
                    'contact_email' => $row['contact_email'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'membership_type' => $row['membership_type']
                ];
            }
            return null;
        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            return null; 
        }
    }

    public function createUser($contact_email, $first_name, $last_name, $membership_type, $password)
    {
        try {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('INSERT INTO member_user (contact_email, first_name, last_name, membership_type, password) VALUES (:contact_email, :first_name, :last_name, :membership_type, :password)');
            $stmt->bindParam(':contact_email', $contact_email, PDO::PARAM_STR);
            $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':membership_type', $membership_type, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPass, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            return false; 
        }
    }

    public function updateUser($id, $contact_email, $first_name, $last_name, $membership_type, $password = null)
    {
        try {
            if ($password) {
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->db->prepare('UPDATE member_user SET contact_email = :contact_email, first_name = :first_name, last_name = :last_name, membership_type = :membership_type, password = :password WHERE id = :id');
                $stmt->bindParam(':password', $hashedPass, PDO::PARAM_STR);
            } else {
                $stmt = $this->db->prepare('UPDATE member_user SET contact_email = :contact_email, first_name = :first_name, last_name = :last_name, membership_type = :membership_type WHERE id = :id');
            }
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':contact_email', $contact_email, PDO::PARAM_STR);
            $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':membership_type', $membership_type, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            return false; 
        }
    }

    public function deleteUser($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM member_user WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            return false; 
        }
    }
}
