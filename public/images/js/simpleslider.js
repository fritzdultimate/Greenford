jQuery(document).ready (function(){
	 		/* Simple slider */
	  	var index = 0;
	  	simpleSlider();
	  	setInterval(simpleSlider, 6000);

	  	function simpleSlider(){
	  		var slides = document.getElementsByClassName('single-slide');

	  		var i;
	  		for ( i = 0; i < slides.length; i++ ){
	  			$(slides[i]).css('display', 'none');
	  		}
	  		index++;
	  		
	  		if ( index > slides.length ) {
	  			index = 1;
	  		}
	  		$(slides[index-1]).css('display', 'block');
	  	}

	  	$(".slider-button").click(function(){
	  		simpleSlider();
	  	});
	 });