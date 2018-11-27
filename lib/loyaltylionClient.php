<?php

namespace LoyaltyLionApp;

/***************************************************/
/******** SDK Name: LoyaltyLion Client API  ********/
/******** By: (Keith) Yuen Ko, Sin          ********/
/******** Date: 2018-11-27                  ********/
/***************************************************/

	class LoyaltyLionClient {
		
		private $points;
		private $url;
		private $credentials;
		private $user;
		private $passwd;
		private $resultArr;
		
		public function __construct($user='', $passwd='') {
			$this->user = $user;
			$this->passwd = $passwd;
		}
		
		public function sendRequest($url, $filter='', $data) {
			
			$newRequest = new requestObj($this->user,$this->passwd);
			$newRequest->sendCURL($url, $filter, $data);
			
			if(!$newRequest->isError()) {
				$this->resultArr  = $newRequest->getResultArr();
			}
	
		}
		
		public function getResult() {
			return $this->resultArr;
		}
		
		public function getRewardPoint() {
			if($this->resultArr==null) {
				return "No data.";
			} else {
				return $this->resultArr['customers'][0]['points_approved'];
			}
		}
		
		public function getUrl() {
			return $this->url;
		}
		
		public function getAllCustomers() {
			$newRequest = new requestObj($this->user,$this->passwd);
			$newRequest->sendCURL("https://api.loyaltylion.com/v2/customers");
			if(!$newRequest->isError()) {
				$this->resultArr = $newRequest->getResultArr();
				return $this->resultArr;
			} else {
				return array('error');
			}
		}
		
		public function getAllActivities() {
			$newRequest = new requestObj($this->user,$this->passwd);
			$newRequest->sendCURL("https://api.loyaltylion.com/v2/activities");
			if(!$newRequest->isError()) {
				$this->resultArr = $newRequest->getResultArr();
				return $this->resultArr;
			} else {
				return array('error');
			}
		}
		
		public function getAllOrders() {
			$newRequest = new requestObj($this->user,$this->passwd);
			$newRequest->sendCURL("https://api.loyaltylion.com/v2/orders");
			if(!$newRequest->isError()) {
				$this->resultArr = $newRequest->getResultArr();
				return $this->resultArr;
			} else {
				return array('error');
			}
		}
	}

	class requestObj {
		
		private $url = null;
		private $credentials = null;
		private $user = null;
		private $passwd = null;
		private $resultArr = null;
		private $isError = false;
	 
		public function __construct($user='', $passwd='') {
			$this->user = $user;
			$this->passwd = $passwd;
		}
		
		public function sendCURL($url, $filter='', $data='') {
			
			if($filter=='') {
				$this->url = $url;
			} else {
				$this->url = $url . "?" . $filter . "=" . $data;
			}
			
			$this->credentials = $this->user . ":" . $this->passwd;
         
			$headers = array(
				"Content-type: text/xml;charset=\"utf-8\"",
				"Accept: text/xml",
				"Cache-Control: no-cache",
				"Pragma: no-cache",
				"SOAPAction: \"run\"",
				"Authorization: Basic " . base64_encode($this->credentials)
			);
		   
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$this->url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
			$data = curl_exec($ch); 

			if (curl_errno($ch)) { 
				$this->isError = true;
				print "Error: " . curl_error($ch); 
			} else { 
				// Show me the result 
				$this->resultArr = json_decode($data, true);
				curl_close($ch); 
			}
			
		}
		
		public function getResultArr() {
			return $this->resultArr;
		}
		
		public function isError() {
			return $this->isError;
		}
		
	}

 ?>
 
 
 
 
 
 
 
 
 
