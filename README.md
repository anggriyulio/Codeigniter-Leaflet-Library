Codeigniter-Leaflet-Library
===========================

![Simple Leaflet JS library for Codeigniter](http://anggriyulio.com/public/images/leaflet-codeigniter.png)


Simple Leaflet JS library for Codeigniter

Features :	
- Create Simple Map
- Add marker / multiple marker
- Custom marker icon


Installation : 

    Upload Leaflet.php file application/libraries/ directory

Using the libraries :

1. Loading library	

		$this->load->library('leaflet');

2. Include Leaflet CSS & JS file in the head section of your document:  

		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script> // or latest jquery
	
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
			'latlng' 		=>'-0.959, 100.39716', // Marker Location
			'popupContent' 	=> 'Hi, iam a popup!!', // Popup Content
			);
			$this->leaflet->add_marker($marker);
		

		$this->data['map'] =  $this->leaflet->create_map();

	On the view file :

		<?php echo $map['html']; ?>
		<?php echo $map['js']; ?>
    
   

    
Feel free to send me an email if you have any problems ;)	

Regards,
	
    
Anggri Yulio P	

<anggriyulio@gmail.com>
	
