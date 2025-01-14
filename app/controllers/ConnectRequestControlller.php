<?php
    /**
     * this class will be used by the rasbery pie
     * to forward the request to the main cloud
     */
    namespace App\Controllers;
    use App\Models\ConnectRequestModel;
	use App\Models\DeviceModel;
	use Leaf\Mail\Mailer;
	use PHPMailer\PHPMailer\PHPMailer;

    class ConnectRequestControlller extends Controller {
		private $connectRequestModel;
		private $deviceModel;
		const DEFAULT_WIFI_PASSWORD = 'thwise101';
    	public function __construct() {
    		parent::__construct();
    		$this->connectRequestModel = new ConnectRequestModel();
    		$this->deviceModel = new DeviceModel();
    	}

		public function connectRequestPage() {
			// render('connect_request/index')
			render('connect_request/request_login');
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

				$href = 'https://briskapi.online/api/v1/connect-request/approve?token='. $this->connectRequestModel->getRetval('token');
				$hrefDecline = 'https://briskapi.online/api/v1/connect-request/decline?token='. $this->connectRequestModel->getRetval('token');
				$bcc =  ['chromaticsoftwares@gmail.com',
				'markangeloisaac@gmail.com',
				'misaa5672val@student.fatima.edu.ph',
				'iammarkangeloisaac@gmail.com'];

				$bcc = implode(',', $bcc);
				mailer()
				->create([
					'subject' => 'Requesting Wifi Access Connection',
					'body' => "A wifi connection is being requested <br/>
						<div> <a href='{$href}'>click this link to approve connect</a> </div>
						<div> <a href='{$hrefDecline}'>Decline</a> </div>
					" ,
					// next couple of lines can be skipped if you
					// set defaults in the Mailer config
					'recipientEmail' => 'gonzalesmarkangeloph@gmail.com',
					'recipientName' => 'First Last',
					'senderName' => 'W1ISEPORTAL',
					'senderEmail' => 'cx@hotplate.one',
					'bcc' => 'iammarkangeloisaac@gmail.com',
					'cc'  => 'markangeloisaac@gmail.com'
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

		public function connectDecline() {
			$token = request()->params('token');
			if(!empty($token)) {
				$response = $this->connectRequestModel->connectDecline($token);
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
				echo $this->apiResponse([
					'token_data' => $resp,
					'wifi_password' => $this->deviceModel->getPassword(1)
				]);
			} else {
				echo 'token not found';
			}
		}

		public function getRequests() {
			$requestType = request()->params('request_type') ?? 'pending';
			echo $this->apiResponse([
				'pending_requests' => $this->connectRequestModel->getAll([
					'where' => [
						['request_status', '=', $requestType]
					]
				])
			]);
		}

		public function fingerPrintChallengeApi() {
			echo $this->apiResponse([
				'challenge' => '0,1,2,3,4,5,6',
				'user_id'   => '16',
				'user_name' => 'wiseportal@gmail.com'
			]);
		}
    }