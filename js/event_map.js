$(document).ready(function() {

	var map = new maplibregl.Map({
		container: 'map',
		style: 'https://demotiles.maplibre.org/style.json', // stylesheet location
		center: [ -4.7397967 ,41.6556348], // starting position [lng, lat]
		zoom: 4, // starting zoom
		style: {
			'version': 8,
			'sources': {
				'raster-tiles': {
					'type': 'raster',
					'tiles': ['https://tile.openstreetmap.org/{z}/{x}/{y}.png'],
					'tileSize': 256,
					'attribution': "© OpenStreetMap contributors",
					'minzoom': 0,
					'maxzoom': 19
				}
			},
			'layers': [
				{
					'id': 'simple-tiles',
					'type': 'raster',
					'source': 'raster-tiles',
					'attribution': "© OpenStreetMap contributors",
				}
			],
			'id': 'blank'
		}
	});

	for (let i = 0; i < appointment_coordinates.length; i++) {
		var meetingIcon = document.createElement('div');
		meetingIcon.classList.add("marker_meeting");
		meetingIcon.innerHTML += '<img class="marker_img" src="img/marker-red.png" title="' + appointment_coordinates[i].name + '">';
		meetingIcon.addEventListener('click', () => {
			window.open(appointment_coordinates[i].url,'_blank');
		});

		const marker = new maplibregl.Marker({element:meetingIcon})
			.setLngLat([parseFloat(appointment_coordinates[i].lon) ,parseFloat(appointment_coordinates[i].lat)])
			.addTo(map);
	}


	function processWheelEvent(evt) {
		evt.preventDefault();
	}
} );



