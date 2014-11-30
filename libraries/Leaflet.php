<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Leaflet Js Class
 *
 * 
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		anggriyulio (Anggri Yulio P)
 * @link		http://anggriyulio.com/
 */

class Leaflet
{
	protected 	$ci;
	var $tileLayer ="http://{s}.tile.osm.org/{z}/{x}/{y}.png";

	// Map State Options
	var $center             ="-0.959, 100.39716";
	var $zoom               ="13";
	var $layers             ="";
	var $map_name 			="map";
	var $minZoom            ="";
	var $maxZoom            ="";
	var $user               ="";
	var $crs                ="L.CRS.EPSG3857";
	
	// Interaction options
	var $dragging           = TRUE;
	var $touchZoom          = TRUE;
	var $scrollWheelZoom    = TRUE;
	var $doubleClickZoom    = TRUE;
	var $boxZoom            = TRUE;
	var $tap                = TRUE;
	var $tapTolerance       = 15;
	var $trackResize        = TRUE;
	var $worldCopyJump      = FALSE;
	var $closePopupOnClick  = TRUE;
	var $bounceAtZoomLimits = TRUE;

	// Control options
	var $zoomControl = TRUE;
	var $attributionControl = TRUE;

	// Events
	var $click            = '';
	var $dblclick         = '';
	var $mousedown        = '';
	var $mouseup          = '';
	var $mouseover        = '';
	var $mouseout         = '';
	var $mousemove        = '';
	var $press            = '';
	var $focus            = '';
	var $blur             = '';
	var $existing         = '';
	var $load             = '';
	var $unload           = '';
	var $creating         = '';
	var $movestart        = '';
	var $move             = '';
	var $moveend          = '';
	var $dragstart        = '';
	var $drag             = '';
	var $dragend          = '';
	var $zoomstart        = '';
	var $zoomend          = '';
	var $zoomlevelschange = '';
	var $resize           = '';
	var $autopanstart     = '';
	var $layeradd         = '';
	var $layerremove      = '';
	var $baselayerchange  = '';
	var $overlayadd       = '';
	var $overlayremove    = '';
	var $locationfound    = '';
	var $locationerror    = '';
	var $popupopen        = '';
	var $popupclose       = '';
	var $customFunction		='';

	var $markers 			= array();


	public function __construct(){
	    $this->ci =& get_instance();
	}

	function leaflet($config = array()) {
		if (count($config) > 0) {
			$this->initialize($config);
		}
	}

	function initialize($config = array()) {
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}

	function add_marker($params = array()) {

		$marker = array();
		//$this->markersInfo['marker_'.count($this->markers)] = array();

		$marker['latLong']      = "-0.9583407792361563,100.3982162475586";
		$marker['icon']         = "";
		$marker['clickable']    = TRUE;
		$marker['draggable']    = FALSE;
		$marker['keyboard']     = TRUE;
		$marker['title']        = "";
		$marker['alt']          = "";
		$marker['zIndexOffset'] = 0;
		$marker['opacity']      = 1.0;
		$marker['riseOnHover']  = FALSE;
		$marker['riseOffset']   = 250;

		// Awesome marker option
		$marker['markerColor'] ="";
		$marker['prefix'] ="";

		// Marker Event 
		$marker['awesomeMarker'] = FALSE;
		$marker['dragend'] ="";
		$marker['customFunction'] ="";
		$marker['iconColor'] ="";
		$marker['spin'] = FALSE;
		$marker['extraClasses'] ="";
		
		$marker['popupContent'] = "";

		$marker_output = '';
		foreach ($params as $key => $value) {
			if (isset($marker[$key])) {
				$marker[$key] = $value;
			}
		}
				
		// Create the marker
		$marker_output .='marker = new L.marker(['.$marker['latLong'].'],({';

		// Start of marker options
		if (!$marker['clickable']) {
			$marker_output .= 'clickable: false,';
		}
		if ($marker['draggable']) {
			$marker_output .= 'draggable: true,';
		}
		
		/* check if awesomeMarker (true) 
		 * docs $ https://github.com/lvoogdt/Leaflet.awesome-markers
		 */
		if ($marker['awesomeMarker']==TRUE) {
			$marker_output .= 'icon: L.AwesomeMarkers.icon({';
			if ($marker['icon']) {
				$marker_output .= '"icon" : "'.$marker['icon'].'",';
			}
			if ($marker['markerColor']) {
				$marker_output .= '"markerColor":"'.$marker['markerColor'].'",';
			}
			if ($marker['prefix']) {
				$marker_output .= '"prefix":"'.$marker['prefix'].'",';
			}
			if ($marker['iconColor']) {
				$marker_output .= '"iconColor":"'.$marker['iconColor'].'",';
			}
			if ($marker['spin']) {
				$marker_output .= '"spin":true,';
			}
			if ($marker['prefix']) {
				$marker_output .= '"prefix":"'.$marker['prefix'].'",';
			}
			$marker_output .= '})';
		} else{
			if ($marker['extraClasses']) {
				$marker_output .= '"extraClasses" : "'.$marker['extraClasses'].'",';
			}
		}

		// End of marker options
		$marker_output .='}))';

		if ($marker['popupContent'] != "") {
			$marker_output .= '.bindPopup("'.$marker['popupContent'].'")';
		}
		$marker_output .='.addTo(map);';

		if ($marker['dragend'] != "") {
			$marker_output .= 'marker.on("dragend", '.$marker['dragend'].');';
		}

		if ($marker['customFunction'] != "") {
			$marker_output .= $marker['customFunction'];
		}

		array_push($this->markers, $marker_output);		
	}


	function create_map() {
		$this->output_js = '';
		$this->output_js_contents = '';
		$this->output_html = '';

		$this->output_js .= '
			<script type="text/javascript">
			 $(document).ready(function() {
			';

		$this->output_js_contents .= '
			var map = L.map("map",{
				center: ['.$this->center.'],
				zoom: '.$this->zoom.',
				dragging: '.$this->dragging.'
			})
			';

		$this->output_js_contents .= '
			L.tileLayer("'.$this->tileLayer.'", {
				
			}).addTo(map)
			';
		$this->output_js .= '
		  	}); 
		';

		if ($this->customFunction !="") {
			$this->output_js_contents .= $this->customFunction;
		}

		if ($this->click != "") {
			$this->output_js_contents .='
			 '.$this->map_name.'.on("click",'.$this->click.');	
			';
		}


		/*
		* Add marker. 
		* @uses add_marker
		*/
		if (count($this->markers)) {
			foreach ($this->markers as $marker) {
				$this->output_js_contents .= $marker;
			}
		}	
		
		$this->output_js .= $this->output_js_contents;
		$this->output_js .= '</script>';

		return array('js'=>$this->output_js);


	}

}

/* End of file leaflet.php */
/* Location: ./application/libraries/leaflet.php */
