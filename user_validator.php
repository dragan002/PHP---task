<?php 

class UserValidator {

    private $data;
    private $errors = [];
    private static $fields = ['ime', 'prezime', 'mobile', 'email'];

    public function __construct($post_data) {
        $this->data = $post_data;
    }

    public function validateForm () {
        foreach(self::$fields as $field) {
            if(!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }
        $this->validateIme();
        $this->validatePrezime();
        $this->validateMobile();
        $this->validateEmail();
        return $this->errors;
    }

    public function validateIme () {
        $val = trim($this->data['ime']);

        if(empty($val)) {
            $this->addError('ime', 'Ime ne moze biti prazno polje');
        } else {
            if(!preg_match('/^[a-zA-Z0-9]{3,12}$/', $val)) {
                $this->addError('ime', 'Ime treba da ima izmedju 3 i 12 karaktera');
            }
        }
    }

    public function validatePrezime () {
        $val = trim($this->data['prezime']);

        if(empty($val)) {
            $this->addError('prezime', 'Prezime ne moze biti prazno polje');
        } else {
            if(!preg_match('/^[a-zA-Z0-9]{3,12}$/', $val)) {
                $this->addError('prezime', 'Prezime treba da ima izmedju 3 i 12 karaktera');
            }
        }

    }

    public function validateMobile () {
        $val = ($this->data['mobile']);

        if(empty($val)) {
            $this->addError('mobile', 'Broj telefona ne moze biti prazno polje');
        } else {
            if(!preg_match('/^[0-9]{10}+$/', $val)) {
            $this->addError('mobile', 'Broj telefona treba da ima brojeve');
            }
            }
        }
    

    public function validateEmail () {
        $val = trim($this->data['email']);

        if(empty($val)) {
            $this->addError('email', 'Email ne moze biti prazno polje');
        } else {
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'email treba da bude validan');
            }
        }
    }

    private function addError($key, $val) {
        $this->errors[$key] = $val;
    }

}


?>