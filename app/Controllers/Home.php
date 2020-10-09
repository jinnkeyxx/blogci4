<?php namespace App\Controllers;
use App\Models\MetaModel;
use App\Models\HeaderModel;
use App\Models\InfoModel;
use App\Models\UserModel;
class Home extends BaseController
{
	
	public $data;
	public $meta;
	public $header;
	public $info;
	public $user;
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		
		$this->data = [];
		$this->meta = new MetaModel();
		$this->header = new HeaderModel();
		$this->info = new InfoModel();
		$this->user = new UserModel();
	}
	public function index()
	{
		
		// echo $this->ipinfo("Visitor", "Country"); // India
		// echo $this->ipinfo("Visitor", "Country Code"); // IN
		// echo $this->ipinfo("Visitor", "State"); // Andhra Pradesh
		// echo $this->ipinfo("Visitor", "City"); // Proddatur
		// echo $this->ipinfo("Visitor", "Address"); // Proddatur, Andhra Pradesh, India

		// print_r($this->ipinfo("Visitor", "Location"));
		// Array ( [city] => Proddatur [state] => Andhra Pradesh [country] => India [country_code] => IN [continent] => Asia [continent_code] => AS )
		$this->data = [
			'title' => 'Trang chủ',
			'location' => $this->ipinfo('Visitor' , 'Address'),
			'weather' => $this->get_weather(),
			'date' => date('H'),
			'meta' => $this->meta->first(),
			'header' => $this->header->first(),
			'info' => $this->info->where('id' , 1)->first(),
			'user' => $this->user->where('id' , session()->get('id'))->fisrt(),
			
		];
		echo view('home/index' , $this->data);
		// echo $this->get_weather();
		
		
	}
	public function ipinfo($ip = NULL, $purpose = "location", $deep_detect = TRUE) 
	{
		$output = NULL;
		if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
			$ip = $_SERVER["REMOTE_ADDR"];
			if ($deep_detect) {
				if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
		}
		$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
		$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
		$continents = array(
			"AF" => "Africa",
			"VN" => "Vietnam",
			"AN" => "Antarctica",
			"AS" => "Asia",
			"EU" => "Europe",
			"OC" => "Australia (Oceania)",
			"NA" => "North America",
			"SA" => "South America"
		);
		if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
			$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
			if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
				switch ($purpose) {
					case "location":
						$output = array(
							"city"           => @$ipdat->geoplugin_city,
							"state"          => @$ipdat->geoplugin_regionName,
							"country"        => @$ipdat->geoplugin_countryName,
							"country_code"   => @$ipdat->geoplugin_countryCode,
							"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
							"continent_code" => @$ipdat->geoplugin_continentCode
						);
						break;
					case "address":
						$address = array($ipdat->geoplugin_countryName);
						if (@strlen($ipdat->geoplugin_regionName) >= 1)
							$address[] = $ipdat->geoplugin_regionName;
						if (@strlen($ipdat->geoplugin_city) >= 1)
							$address[] = $ipdat->geoplugin_city;
						$output = implode(", ", array_reverse($address));
						break;
					case "city":
						$output = @$ipdat->geoplugin_city;
						break;
					case "state":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "region":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "country":
						$output = @$ipdat->geoplugin_countryName;
						break;
					case "countrycode":
						$output = @$ipdat->geoplugin_countryCode;
						break;
				}
			}
		}
		return $output;
	}
	public function get_weather()
	{
		#http://api.openweathermap.org/data/2.5/forecast?q=Hanoi,vn&APPID=3f6ff77d87316e8f9bd0c0272c72baa6&units=metric
		$url="http://api.openweathermap.org/data/2.5/weather?q=Hanoi,vn,&appid=3f6ff77d87316e8f9bd0c0272c72baa6";
		$json=file_get_contents($url);
		$data=json_decode($json);
		return $data->coord->lat;
	}

	//--------------------------------------------------------------------

}