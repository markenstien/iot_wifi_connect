<?php 
    namespace App\Controllers;
    use App\Models\DeviceModel;

    class DeviceController extends Controller
    {
        private $deviceModel;
        
        public function __construct()
        {
            $this->deviceModel = new DeviceModel();
        }

        public function updatePassword() {
            $message = '';
            if(parent::isSubmitted()) {
                $req = request()->postData();
                $this->deviceModel->updatePassword(1, $req['new_password']);
                $message = 'Password Updated';
            } else {
                $message = '';
            }

            $password = $this->deviceModel->where('id', '1')->first();
            render('device_controller/update_password', [
                'password' => $password['wifi_password'],
                'message' => $message
            ]);
        }

        public function getPassword() {
            $password = $this->deviceModel->where('id', '1')->first();
            echo $this->apiResponse($password);
        }
    }