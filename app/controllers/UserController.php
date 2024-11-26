<?php 
    namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Models\UserModel;
use Illuminate\Contracts\Session\Session;

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

            if(empty(SessionHelper::get('userauth'))) {

            }

            render('user/index');
        }

        /**
         * register user
         */
        public function store() {

        }

        public function edit($id) {
            render('user/edit');
        }
    }