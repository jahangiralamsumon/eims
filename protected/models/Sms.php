<?php

class Sms extends CFormModel
{
	public $numbers;
	public $message;
    public $class_id;
    public $department_id;
    public $file;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
				array('message,', 'required',),
				array('numbers,message,', 'required','on'=>'basic_send'),
				array('file', 'file','allowEmpty' =>false,'types' => 'csv', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!','on'=>'bulk_sms'),
				array('class_id,department_id','safe'),
		);
	}




	public function attributeLabels()
	{
		return array(
				'numbers'=>'Numbers',
				'message'=>'Message',
				'class_id'=>'Class',
				'department_id'=>'Department'
		);
	}


	public  static  function sms__unicode($message){
		$hex1='';
		if (function_exists('iconv')) {
			$latin = @iconv('UTF-8', 'ISO-8859-1', $message);
			if (strcmp($latin, $message)) {
				$arr = unpack('H*hex', @iconv('UTF-8', 'UCS-2BE', $message));
				$hex1 = strtoupper($arr['hex']);
			}
			if($hex1 ==''){
				$hex2='';
				$hex='';
				for ($i=0; $i < strlen($message); $i++){
					$hex = dechex(ord($message[$i]));
					$len =strlen($hex);
					$add = 4 - $len;
					if($len < 4){
						for($j=0;$j<$add;$j++){
							$hex="0".$hex;
						}
					}
					$hex2.=$hex;
				}
				return $hex2;
			}
			else{
				return $hex1;
			}
		}
		else{
			print 'iconv Function Not Exists !';
		}
	}

	public static function send_message($message,$mobile,$msgtype,$dlr){

		$host="121.241.242.114";
		$port="8080";
		$username="nexg-star";
		$password="123456";
		$sender=InstitutionConfigurations::model()->findByAttributes(array('id'=>10))->config_value;

		if($msgtype=="2" ||$msgtype=="6") {
			//Call The Function Of String To HEX.
			$message =self::sms__unicode($message);
			try{
				//Smpp http Url to send sms.

				$live_url="http://".$host.":".$port."/bulksms/bulksms?username=".$username."&password=".$password."&type=".$msgtype."&dlr=".$dlr."&destination=".$mobile."&source=".$sender."&message=".$message."";
				$parse_url=file($live_url);
				return  $parse_url[0];
			}catch(Exception $e){
				//echo 'Message:' .$e->getMessage();
				return 0;
			}
		}
		else{
			$message=urlencode($message);
			try{
				//Smpp http Url to send sms.
				$live_url="http://".$host.":".$port."/bulksms/bulksms?username=".$username."&password=".$password."&type=".$msgtype."&dlr=".$dlr."&destination=".$mobile."&source=".$sender."&message=".$message."";
				$parse_url=file($live_url);
				return $parse_url[0];
			}
			catch(Exception $e){
				//echo 'Message:' .$e->getMessage();
				return  0;
			}
		}

	}

	public static function check_sms_limit($numbers){
		$number_arr=explode(',',$numbers);
		$quantity=count($number_arr);
		$sms_limit=InstitutionConfigurations::model()->findByAttributes(array('id'=>9))->config_value;
		if(($sms_limit-$quantity)>=0){
			return true;
				
		}
		else{
			return false;
		}


	}

}