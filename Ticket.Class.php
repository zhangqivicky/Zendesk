<?php

// base class with member properties and methods
class TicketApi {

	/**
	 * Get the data based on different types of api calls
	 *
	 * @return mixed json data from api call
	 */
	private function callApi($type){
		$config = parse_ini_file('apiconfig.ini');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
		curl_setopt($ch, CURLOPT_URL, $config["apiurl"]."/".$type);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERPWD, $config["username"].":".$config["password"]);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$res = array();
		$res["code"] = $httpcode;
		$res["data"] = $data;
		//print_r($res);
		return $res;
	}
	/**
	 * Fetch all the tickets by calling zendesk api
	 *
	 * @return mixed the list of tickets
	 */
	public function getAllTickets() {
		$res = $this->callApi("tickets.json");
		// handle 404 error
		if($res["code"] == 404){ 
			$res["error"] = $this->getErrorMsg("Requested API url is not valid");
			return $res;
		}
		$resArr = json_decode($res["data"], true);
		// handle api error in processing the request
		if(isset($resArr["error"])) {
			$resArr["error"] = $this->getErrorMsg($resArr["error"]);
			return $resArr;
		}
		return $resArr["tickets"];
	}

	/**
	 * Fetch one ticket by call zendesk api
	 *
	 * @param $id ticket id
	 * @return mixed ticket details
	 */
	public function getTicketDetail($id) {
		$res = $this->callApi("tickets/$id.json");
		// Handle 400 and 404 error
		if($res["code"] == 400){ 
			$res["error"] = $this->getErrorMsg("Id must be an integer");
			return $res;
		}
		if($res["code"] == 404){ 
			$res["error"] = $this->getErrorMsg("No record found, could be caused by wrong api url or id");
			return $res;
		}
		// Handle api error in processing the request
		$resArr = json_decode($res["data"], true);
		if(isset($resArr["error"])) {
			$resArr["error"] = $this->getErrorMsg($resArr["error"]);
			return $resArr;
		}
		$ticket = $resArr["ticket"];
		
		// Continue to get user's name by user id
		$requester_id = $ticket["requester_id"];
		$res = $this->callApi("users/$requester_id.json");
		if($res["code"] == 200){		
			$resArr = json_decode($res["data"], true);
			$ticket["requester"] = $resArr["user"]["name"];
		}else $ticket["requester"] = "";
		
		return $ticket;
	}
	
	 /**
	 * Build error message shown to users
	 *
	 * @param $error api error
	 * @return string error message
	 */
	private function getErrorMsg($error){
			$msg = "<p class=\"intro\">Oh notes, something went wrong!</p>";
			$msg .= "<p class=\"error\">Error: $error</p>";
			return $msg;
	}

	/**
	 * Limit title length
	 *
	 * @param $title article title
	 * @return string the title with a length limitation
	 */
	public function shorten_title($title, $maxlen){
		if(strlen($title) <= $maxlen) return $title;
		$pos = strrpos(substr($title, 0, $maxlen), " ");
		if($pos !== false) $title = substr($title, 0, $pos)."...";
		return $title;
	}
}