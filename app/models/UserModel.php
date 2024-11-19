<?php 
    namespace App\Models;
    
    class UserModel extends Model {
        protected $table = 'users';
        public $timestamps  = false;

        public function saveAuthn($email, $webauth_data) {
            if(!empty($webauth_data)) {
                $user = parent::where('email', $email)->first();

                if($user) {
                    $user->webauthn = $webauth_data;
                    $user->save();

                    return true;
                } else {
                    //user not found
                    return false;
                }
            }
            return false;
        }

        public function getauthn($email) {
            return parent::where('email', $email)->first();
        }
    }