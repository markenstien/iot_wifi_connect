<?php 
    namespace App\Controllers;
    use App\Models\UserModel;

    class UserController extends Controller {
        private $userModel;

        public function __construct()
        {
            parent::__construct();
            $this->userModel = new UserModel();
        }

        public function saveauthn() {
            $email = request()->params('email');
            $webauthdata = request()->params('webauthdata');
            $resp = $this->userModel->saveAuthn($email, $webauthdata);
            
            if($resp) {
                echo $this->apiResponse([
                    'saved_data' => 'true',
                    'webauthdata' => $webauthdata
                ]);
            } else {
                echo $this->apiResponse([
                    'saved_data' => 'false'
                ]);
            }
        }

        public function getauthn() {
            $email = request()->params('email');
            $resp = $this->userModel->getauthn($email);
            echo $this->apiResponse([
                'authn' => $resp['webauthn']
            ]);
        }
        /**
         * get users
         */
        public function index() {

        }

        /**
         * register user
         */
        public function store() {

        }
    }