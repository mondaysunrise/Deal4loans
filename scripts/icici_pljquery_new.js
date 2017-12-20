	$(function() {
					$( "#slider-range-min" ).slider({
			range: "min",
			value: $("#untouched_laCA").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la").val(),
			slide: function( event, ui ) {
				$( "#amount" ).val( "" + ui.value );
			}
		});
		$( "#amount" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
		

	});

	
$(function() {
		$( "#slider-range-min1" ).slider({
			range: "min",
			value: $("#untouched_tenCA").val(),
			step: 1,
			min: 1,
			max: $("#untouched_ten").val(),
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

	

