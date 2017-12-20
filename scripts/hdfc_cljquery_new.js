	$(function() {
			$( "#slider-range-min_0" ).slider({
			range: "min",
			value: $("#nwLA_0").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_0").val(),
			slide: function( event, ui ) {
				$( "#amount_0" ).val( "" + ui.value );
			}
		});
		$( "#amount_0" ).val( "" + $( "#slider-range-min_0" ).slider( "value" ) );
	});

	$(function() {
			$( "#slider-range-min_1" ).slider({
			range: "min",
			value: $("#nwLA_1").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_1").val(),
			slide: function( event, ui ) {
				$( "#amount_1" ).val( "" + ui.value );
			}
		});
		$( "#amount_1" ).val( "" + $( "#slider-range-min_1" ).slider( "value" ) );
	});


	$(function() {
			$( "#slider-range-min_2" ).slider({
			range: "min",
			value: $("#nwLA_2").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_2").val(),
			slide: function( event, ui ) {
				$( "#amount_2" ).val( "" + ui.value );
			}
		});
		$( "#amount_2" ).val( "" + $( "#slider-range-min_2" ).slider( "value" ) );
	});
	

	$(function() {
			$( "#slider-range-min_3" ).slider({
			range: "min",
			value: $("#nwLA_3").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_3").val(),
			slide: function( event, ui ) {
				$( "#amount_3" ).val( "" + ui.value );
			}
		});
		$( "#amount_3" ).val( "" + $( "#slider-range-min_3" ).slider( "value" ) );
	});


$(function() {
		$( "#slider-range-min1_0" ).slider({
			range: "min",
			value: $("#nwtenu_0").val(),
			step: 6,
			min: 12,
			max: $("#untouched_ten_0").val(),
			slide: function( event, ui ) {
				$( "#amount1_0" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_0" ).val( "" + $( "#slider-range-min1_0" ) .slider( "value" ) );
	});

	$(function() {
		$( "#slider-range-min1_1" ).slider({
			range: "min",
			value: $("#nwtenu_1").val(),
			step: 6,
			min: 12,
			max: $("#untouched_ten_1").val(),
			slide: function( event, ui ) {
				$( "#amount1_1" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_1" ).val( "" + $( "#slider-range-min1_1" ) .slider( "value" ) );
	});

$(function() {
		$( "#slider-range-min1_2" ).slider({
			range: "min",
			value: $("#nwtenu_2").val(),
			step: 6,
			min: 12,
			max: $("#untouched_ten_2").val(),
			slide: function( event, ui ) {
				$( "#amount1_2" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_2" ).val( "" + $( "#slider-range-min1_2" ) .slider( "value" ) );
	});


	$(function() {
		$( "#slider-range-min1_3" ).slider({
			range: "min",
			value: $("#nwtenu_3").val(),
			step: 6,
			min: 12,
			max: $("#untouched_ten_3").val(),
			slide: function( event, ui ) {
				$( "#amount1_3" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_3" ).val( "" + $( "#slider-range-min1_3" ) .slider( "value" ) );
	});

$(document).ready(function(){
  $("#slider-range-min1_0").mousemove(function(){
   $( "#amount_0" ).val($("#nwLA_0").val());
   $("#LA_dv_0").val($("#untouched_la_0").val());
   $( "#slider-range-min_0" ).slider({
			range: "min",
			value: $("#nwLA_0").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_0").val(),
			slide: function( event, ui ) {
				$( "#amount_0" ).val( "" + ui.value );
			}
		});
		$( "#amount_0" ).val( "" + $( "#slider-range-min_0" ).slider( "value" ) );
  });
});

$(document).ready(function(){
  $("#slider-range-min1_1").mousemove(function(){
   $( "#amount_1" ).val($("#nwLA_1").val());
   $("#LA_dv_1").val($("#untouched_la_1").val());
   $( "#slider-range-min_1" ).slider({
			range: "min",
			value: $("#nwLA_1").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_1").val(),
			slide: function( event, ui ) {
				$( "#amount_1" ).val( "" + ui.value );
			}
		});
		$( "#amount_1" ).val( "" + $( "#slider-range-min_1" ).slider( "value" ) );
  });
});

$(document).ready(function(){
  $("#slider-range-min1_2").mousemove(function(){
   $( "#amount_2" ).val($("#nwLA_2").val());
   $("#LA_dv_2").val($("#untouched_la_2").val());
   $( "#slider-range-min_2" ).slider({
			range: "min",
			value: $("#nwLA_2").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_2").val(),
			slide: function( event, ui ) {
				$( "#amount_2" ).val( "" + ui.value );
			}
		});
		$( "#amount_2" ).val( "" + $( "#slider-range-min_2" ).slider( "value" ) );
  });
});

$(document).ready(function(){
  $("#slider-range-min1_3").mousemove(function(){
   $( "#amount_3" ).val($("#nwLA_3").val());
   $("#LA_dv_3").val($("#untouched_la_3").val());
   $( "#slider-range-min_3" ).slider({
			range: "min",
			value: $("#nwLA_3").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_3").val(),
			slide: function( event, ui ) {
				$( "#amount_3" ).val( "" + ui.value );
			}
		});
		$( "#amount_3" ).val( "" + $( "#slider-range-min_3" ).slider( "value" ) );
  });
});

$(document).ready(function(){
  $("#slider-range-min1_0").mouseleave(function(){
   $( "#amount_0" ).val($("#nwLA_0").val());
   $("#LA_dv_0").val($("#untouched_la_0").val());
   $( "#slider-range-min_0" ).slider({
			range: "min",
			value: $("#nwLA_0").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_0").val(),
			slide: function( event, ui ) {
				$( "#amount_0" ).val( "" + ui.value );
			}
		});
		$( "#amount_0" ).val( "" + $( "#slider-range-min_0" ).slider( "value" ) );
  });
});

$(document).ready(function(){
  $("#slider-range-min1_1").mouseleave(function(){
   $( "#amount_1" ).val($("#nwLA_1").val());
   $("#LA_dv_1").val($("#untouched_la_1").val());
   $( "#slider-range-min_1" ).slider({
			range: "min",
			value: $("#nwLA_1").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_1").val(),
			slide: function( event, ui ) {
				$( "#amount_1" ).val( "" + ui.value );
			}
		});
		$( "#amount_1" ).val( "" + $( "#slider-range-min_1" ).slider( "value" ) );
  });
});

$(document).ready(function(){
  $("#slider-range-min1_2").mouseleave(function(){
   $( "#amount_2" ).val($("#nwLA_2").val());
   $("#LA_dv_2").val($("#untouched_la_2").val());
   $( "#slider-range-min_2" ).slider({
			range: "min",
			value: $("#nwLA_2").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_2").val(),
			slide: function( event, ui ) {
				$( "#amount_2" ).val( "" + ui.value );
			}
		});
		$( "#amount_2" ).val( "" + $( "#slider-range-min_2" ).slider( "value" ) );
  });
});
$(document).ready(function(){
  $("#slider-range-min1_3").mouseleave(function(){
   $( "#amount_3" ).val($("#nwLA_3").val());
   $("#LA_dv_3").val($("#untouched_la_3").val());
   $( "#slider-range-min_3" ).slider({
			range: "min",
			value: $("#nwLA_3").val(),
			min: 100000,
			step: 10000,
			max:  $("#untouched_la_3").val(),
			slide: function( event, ui ) {
				$( "#amount_3" ).val( "" + ui.value );
			}
		});
		$( "#amount_3" ).val( "" + $( "#slider-range-min_3" ).slider( "value" ) );
  });
});
