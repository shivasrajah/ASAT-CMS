<?php
class User extends BaseSql{

    protected $id;
    protected $email;
    protected $login;
    protected $password;
    protected $status;
    protected $date_inserted;
    protected $date_updated;
    protected $id_groupuser;
    protected $token;
    protected $reset_at;

    protected $validation = array(

        'email' => array(

            "empty" => false,
            "email" => true,
        ),

        'login' => array(

            "empty" => false,
            "lenght" => array (3,20),
            "alphanumeric" => true,
        ),

        'password' => array(

            "empty" => false,
            "lenght" => array (8,16),
        ),
        
        'password_confirm' => array (

            "empty" => false,
            "lenght" => array (8,16),
        ),

    );

   public function __construct(){

       parent::__construct();
   }

   //----------------
    //----SETTERS-----
    //----------------

   public function setId($id){
       $this->id=$id;
   }
    public function setEmail($email){
        $this->email=trim($email);
    }
    public function setLogin($login){
        $this->login=trim($login);
    }
    public function setPwd($pwd){
        $this->password=password_hash($pwd, PASSWORD_DEFAULT);
    }
    public function setStatus($status){
        $this->status= $status;
    }
    public function setIdGroupUser($id_groupuser){
        $this->id_groupuser = $id_groupuser;
    }
    public function setDateInserted(){
        $this->date_inserted = date("Y-m-d H:i:s");
    }
    public function setDateUpdated(){
        $this->date_updated = date("Y-m-d H:i:s");
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function setResetAt($date = 0){

        if($date == 0) $this->reset_at = date("Y-m-d H:i:s");
        else $this->reset_at = NULL;
    }

   //----------------
    //----GETTERS-----
    //----------------

   public function getId(){
       return $this->id;
   }
    public function getEmail(){
        return $this->email;
    }
    public function getLogin(){
        return $this->login;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getIdGroupUser(){
        return $this->id_groupuser;
    }
    public function getDateCreated(){
        return $this->date_inserted;
    }
    public function getDateUpdated(){
        return $this->date_updated;
    }
    public function getToken(){
        return $this->token;
    }
    public function getResetAt(){
        return $this->reset_at;
    }

    public function getInscriptionForm(){
        return [
            "struct"=>[
                "method"=>"POST",
                "action"=>"/user/add",
                "submit"=>"Creer un compte",
                 "class" => "bouton",
                 "id" => "bt1",
            ],
            "data"=>[
                "login"=>[
                    "type"=>"text",
                    "placeholder"=>"Login",
                    "required"=>1,
                    "class" => "input",
                    "pattern" => "[a-zA-Z0-9]+",
                    "maxlength" => 20,
                    "minlength" => 3
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Adresse e-mail",
                    "required"=>1,
                    "class" => "input"
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Mot de passe",
                    "required"=>1,
                    "class" => "input",
                    "maxlength" => 16,
                    "minlength" => 8
                ],
                "password_confirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmer votre mot de passe",
                    "required"=>1,
                    "class" => "input",
                    "maxlength" => 16,
                    "minlength" => 8
                ]
            ]
        ];
    }
    public function getConnectionForm(){
        return [
            "struct" => [
                "method"=>"POST",
                "action"=>"/user/login",
                "submit"=>"Connexion",
                "class" => "basic-button",
            ],
            "data" => [
                "login"=>[
                    "type"=>"text",
                    "class" => "basic-input",
                    "placeholder"=>"Login",
                    "required"=>1
                ],
                "password"=>[
                    "type"=>"password",
                    "class" => "basic-input",
                    "placeholder"=>"Mot de passe",
                    "required"=>1
                ]
            ]
        ];
    }

    public function getForgetForm(){
        return [
            "struct" => [
                "method"=>"POST",
                "action"=>"/user/forget",
                "submit"=>"M'envoyer les instructions par e-mail ",
                "class" => "basic-button",
            ],
            
            "data" => [
                "email"=>[
                    "type"=>"email",
                    "class" => "basic-input",
                    "placeholder"=>"Adresse e-mail",
                    "required"=>1
                ]
            ]
        ];
    }

    public function getPasswordForm($id , $token){
        return [
            "struct" => [
                "method"=>"POST",
                "action"=>"/user/password/".$id."-".$token,
                "submit"=>"Changer le mot de passe",
                "class" => "basic-button",
            ],

            "data" => [
                "password"=>[
                    "type"=>"password",
                    "class" => "basic-input",
                    "placeholder"=>"Nouveau mot de passe",
                    "required"=>1,
                    "maxlength" => 16,
                    "minlength" => 8
                ],
                "password_confirm"=>[
                    "type"=>"password",
                    "class" => "basic-input",
                    "placeholder"=>"Confirmer nouveau mot de passe",
                    "required"=>1,
                    "maxlength" => 16,
                    "minlength" => 8
                ]
            ]
        ];
    }
}