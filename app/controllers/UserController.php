<?php 
    namespace App\Controllers;

    use App\Helpers\SessionHelper;
    use App\Models\UserModel;
    use Illuminate\Contracts\Session\Session;
    use Illuminate\Support\Facades\URL;
    use Leaf\Config;

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
            $message = '';
            if($this->isSubmitted()) {
                $post = request()->postData();

                $user = $this->userModel->where([
                    ['email', '=', $post['email']],
                    ['password', '=', $post['password']]
                ])->first();

                if(!$user) {
                    $message = 'user not found';
                } else {
                    //set session
                    SessionHelper::set('userid', $user->id);
                    return redirect('../request-page');
                }
            }

            if(!empty(SessionHelper::get('userid'))) {
                redirect('../user/edit/' . SessionHelper::get('userid'), ['message' => $message]);
            } else {
                render('user/index', ['message' => $message]);
            }
            
        }

        /**
         * register user
         */
        public function store() {

        }

        public function edit($id) {
            if(!SessionHelper::get('userid')) {
                return redirect('../../');
            }
            $message = '';
            if($this->isSubmitted()) {
                $post = request()->postData();
                $user = $this->userModel->where('id', $id)->first();

                $user->password = $post['password'];
                $response = $user->save();

                $message = 'password updataed';
            }
            render('user/edit', [
                'message' => $message
            ]);
        }

        public function logout() {
            session_destroy();
            SessionHelper::remove('userid');
            return redirect('../user/login');
        }
    }