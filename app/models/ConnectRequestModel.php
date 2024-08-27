<?php 
    namespace App\Models;
    
    class ConnectRequestModel extends Model {
        protected $table = 'request_connect_tokens';
        public $timestamps  = false;


        public function connectRequest($cnct_rqst_data = '') {
            $cnct_rqst_data = !empty($cnct_rqst_data) ? json_encode($cnct_rqst_data) : '';
            $token = $this->createToken();
            $connectRequest = new ConnectRequestModel();
            $connectRequest->token = $token;
            $connectRequest->flag_used = false;
            $connectRequest->cnct_rqst_data = $cnct_rqst_data;
            $connectRequest->request_status = 'pending';
            $connectRequest->created_at = tick()->format('YYYY-MM-DD HH:mm:ss');
            $id = $connectRequest->save();
            $this->setRetval('token', $token);
            
            return $id;
        }

        public function connectApprove($token) {
            $exist = $this->getByToken($token);
            if($exist && !$exist->flag_used) {
                if($exist->flag_used) {
                    //token already used
                    parent::setRetval('connect-approve-error', 'Connect request is already approved');
                    return false;
                }
                $exist->flag_used = true;
                $exist->request_status = 'approved';
                $exist->save();
                return true;
            } else {
                parent::setRetval('connect-approve-error', 'Connect request token not found');
                return false;
            }
        }

        public function getByToken($token) {
            return parent::where('token', $token)->first();
        }

        private function createToken($length = 5) {
            $result = '';
            for($i = 0; $i < $length; $i++) {
                $result .= mt_rand(1, 9);
            }
            return $result;
        }
    }