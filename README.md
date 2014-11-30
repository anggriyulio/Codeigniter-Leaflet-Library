Codeigniter-Leaflet-Library
===========================

Simple Leaflet JS library for Codeigniter

Features :	
- Create Simple Map
- Add marker / multiple marker
- Custom JavaScript Function
- Support Leaflet.awesome-markers for custom marker icon

Installation : 

    Upload Leaflet.php file application/libraries/ directory

Using the libraries :

1. Loading library	

		$this-load-libraries('leaflet');

2. Include Leaflet CSS & JS file in the head section of your document:  

		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />	
	
		<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>

3. Let's show the map !
    Controller :

    	$config = array(
			'center'         => '-0.959, 100.39716', // Center of the map
			'zoom'           => 12, // Map zoom
			);
		$this->leaflet->initialize($config);
        
		$marker = array(
			'latLong' 		=>'-0.959, 100.39716', // Marker Location
			'popupContent' 	=> 'Hi, i'am a popup!!', // Popup Content
			);
			$this->leaflet->add_marker($marker);
		}

		$this->data['map'] =  $this->leaflet->create_map();

	On the view file :
	
		<?php echo $map['js']; ?>
    
   
   Work with [Leaflet.awesome-markers](https://github.com/lvoogdt/Leaflet.awesome-markers "Leaflet.awesome-markers") :
   
		$marker = array(
      		............
      		'awesomeMarker' => TRUE,
      		'icon'=> 'home',
      		'prefix' => 'fa',
      		'markerColor'=> 'red',
		 ............
		);
		this->leaflet->add_marker($marker);
    
    
Feel free to send me an email if you have any problems ;)	

Regards,
	
    
Anggri Yulio P	

<anggriyulio@gmail.com>
	
