<?php

class User {

    private $id;
    private $name;
    private $username;
    private $password;
    private $email;
    private $adresa;

    public function Korisnik() {
    }

    public function set($id, $name, $username, $password, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->adresa = $_SERVER["REMOTE_ADDR"];
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getAdresa() {
        return $this->adresa;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setAdresa($adresa) {
        $this->adresa = $adresa;
    }

}

?>
