<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/simplepay/class_SimplePay.php
	# ----------------------------------------------------------------------------------------------------

	class SimplePay {

		public $request_method;
		public $gateway_url;

		public $access_key;
		public $secret_key;

		public $signature_version;
		public $signature_method;
		public $signature;

		public $form_params;
		public $extra_form_params;

		function SimplePay (array $params) {
			if ($params && is_array($params)) {
				foreach ($params as $key => $value) {
					$this->$key = $value;
				}
			}
		}

		function setFormParams ($params, $extra_params = false) {
			if ($params && is_array($params)) {
				$this->form_params["accessKey"] = $this->access_key;
				$this->form_params["SignatureVersion"] = $this->signature_version;
				$this->form_params["SignatureMethod"] = $this->signature_method;
				foreach ($params as $key => $value) {
					$this->form_params[$key] = $value;
				}			
			}

			if ($extra_params && is_array($extra_params)) {
				foreach ($extra_params as $key => $value) {
					$this->extra_form_params["extra_".$key] = $value;
				}
			}

			$this->generateSignature();
		}

		function getFormInputs () {
			unset($inputCode);
			if ($this->form_params && is_array($this->form_params)) {
				foreach ($this->form_params as $key => $value) {
					$inputCode .= "<input type=\"hidden\" name=\"$key\" value=\"$value\" />\n";
				}
			}

			$inputCode .= "<input type=\"hidden\" name=\"Signature\" value=\"".$this->signature."\" />\n";

			if ($this->extra_form_params && is_array($this->extra_form_params)) {
				foreach ($this->extra_form_params as $key => $value) {
					$inputCode .= "<input type=\"hidden\" name=\"$key\" value=\"$value\" />\n";
				}
			}

			return $inputCode;
		}

		function generateSignature () {
			$urlParts = parse_url($this->gateway_url);

			$stringToSign = "";

			if ($this->signature_version == 1) {
				uksort($this->form_params, 'strcasecmp');
				foreach ($this->form_params as $parameterName => $parameterValue) {
					$stringToSign .= $parameterName . $parameterValue;
				}
			} else if ($this->signature_version == 2) {
				uksort($this->form_params, 'strcmp');
				$stringToSign = $this->request_method;
				$stringToSign .= "\n";

				if ($urlParts["host"] == null) {
					$urlParts["host"] = "";
				} 
				$stringToSign .= $urlParts["host"];
				$stringToSign .= "\n";

				if (!isset ($urlParts["path"])) {
					$urlParts["path"] = "/";
				}
				$uriencoded = implode("/", array_map(array("SimplePay", "_urlencode"), explode("/", $urlParts["path"])));
				$stringToSign .= $uriencoded;
				$stringToSign .= "\n";

				$queryParameters = array();
				foreach ($this->form_params as $key => $value) {
					$queryParameters[] = $key . '=' . $this->_urlencode($value);
				}
				$stringToSign .= implode('&', $queryParameters);
			}

			if ($this->signature_method === 'HmacSHA1') {
				$hash = 'sha1';
			} else if ($this->signature_method === 'HmacSHA256') {
				$hash = 'sha256';
			}

			$this->signature = base64_encode(
				hash_hmac($hash, $stringToSign, $this->secret_key, true)
			);
		}

		private static function _urlencode($value) {
			return str_replace('%7E', '~', rawurlencode($value));
		}
	}

?>
