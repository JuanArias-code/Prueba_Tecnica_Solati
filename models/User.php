<?php
class User
{
    private $member_id;
    private $contact_email;
    private $first_name;
    private $last_name;
    private $membership_type;
    private $password;

    public function __construct($member_id, $contact_email, $first_name, $last_name, $membership_type, $password)
    {
        $this->member_id = $member_id;
        $this->contact_email = $contact_email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->membership_type = $membership_type;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContacemail()
    {
        return $this->contact_email;
    }

    public function getFirstname()
    {
        return $this->first_name;
    }

    public function getLastname()
    {
        return $this->last_name;
    }

    public function getMembership()
    {
        return $this->membership_type;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
