<?php
    /**
     * this class will be used by the rasbery pie
     * to forward the request to the main cloud
     */
    namespace App\Controllers;
    use App\Models\ConnectRequestModel;
	use Leaf\Mail\Mailer;
	use PHPMailer\PHPMailer\PHPMailer;

    class ConnectRequestControlller extends Controller {
		private $connectRequestModel;
    	public function __construct() {
    		parent::__construct();
    		$this->connectRequestModel = new ConnectRequestModel();
    	}
        /**
         *API CONNECT REQUEST
         * returns token*/
        public function connectRequest() {
        	$response = $this->connectRequestModel->connectRequest();

        	if($response) {
				Mailer::connect([
					'host' => 'hotplate.one',
					'port' => '587',
					'security' => PHPMailer::ENCRYPTION_STARTTLS,
					'auth' => [
						'username' => 'cx@hotplate.one',
						'password' => 'zK9!0*#IDO7z'
					]
				]);

				Mailer::config([
					'keepAlive' => true,
					'debug' => 'SERVER',
					'defaults' => [
						'recipientEmail' => 'name@mail.com',
						'recipientName' => 'First Last',
						'senderName' => 'Leaf Mail',
						'senderEmail' => 'mychi@leafphp.dev',
					],
				]);

				$href = 'http://localhost/api_development/api_iot_wifi_connect/api/v1/connect-request/approve?token='. $this->connectRequestModel->getRetval('token');
				mailer()
				->create([
					'subject' => 'Leaf Mail Test',
					'body' => "This is a test mail from Leaf Mail using gmail <br/>
						<a href='{$href}'>click this link to approve connect</a>" ,
					// next couple of lines can be skipped if you
					// set defaults in the Mailer config
					'recipientEmail' => 'gonzalesmarkangeloph@gmail.com',
					'recipientName' => 'First Last',
					'senderName' => 'Leaf Mail',
					'senderEmail' => 'cx@hotplate.one',
				])
				->send();
        		//send email request
        		echo parent::apiResponse([
        			'token' => $this->connectRequestModel->getRetval('token'),
					'link' => $href
        		]);
        	} else {
        		echo parent::apiResponse([
        			'message' => 'connect request:: connect-request failed',
        		], false);
        	}
        }

		public function connectApprove() {
			$token = request()->params('token');
			if(!empty($token)) {
				$response = $this->connectRequestModel->connectApprove($token);
				if($response) {
					echo 'request approved';
				} else {
					echo 'request not approved';
				}
			}
		}

		/**
		 * keep alive
		 */
		public function observeToken() {
			$token = request()->params('token');
			if(!empty($token)) {
				$resp = $this->connectRequestModel->getByToken($token);
				echo $this->apiResponse([$resp]);
			} else {
				echo 'token not found';
			}
		}
    }