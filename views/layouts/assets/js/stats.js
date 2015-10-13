var StatisticsForm = function () {
	"use strict";
	var mydata = [];
	var selectedLocationId=$('#selectedLocationId').val();
	var loadSparkData = function(){
	    $.getJSON('/data/stats/weeklystats?type=order&selectedLocationId='+selectedLocationId,{},function(response){
	    	console.log( response.data );
	    	var i=0;
	    	$.each( response.data, function( key, value ) {
	    		//console.log( "key", key );
	    		console.log( "value: ", value );
	    		var myvarde = [];
	    		var datestring ={};
	    		var totalvarde=0;
	    		var k=0;
	    		$.each( value, function(nyckel, varde){
	    			//console.log( "varde: ", varde );
	    			myvarde.push( varde );
	    			totalvarde=totalvarde+varde;
	    			datestring[k]=nyckel;
	    			k++;
	    		});
	    		console.log( 'datestring: ', datestring );
				var html1='<div class="col-md-6">'+
						'<div class="panel panel-blue">'+
							'<div class="panel-body padding-20 text-center">'+
								'<div class="space10">'+
									'<h5 class="text-white semi-bold no-margin p-b-5">'+key+'</h5>'+
									'<h1>'+totalvarde+'</h1>'+
									'Réservations'+
								'</div>'+
								'<div>'+
									'<span class="dynamicsparkline'+i+'">Loading..</span>'+
								'</div>'+
								'<span class="text-light"><i class="fa fa-clock-o"></i> 1 hour ago</span>'+
							'</div>'+
						'</div>'+
					'</div>';
	    		$('.addsparkline').append( html1 );
	    		$('.dynamicsparkline'+i).sparkline(myvarde, {type: "line", lineColor: '#ffffff', width: "80%", height: "70",fillColor: "", spotRadius: 4,lineWidth: 2,resize: true,spotColor: '#ffffff',minSpotColor: '#ffffff',maxSpotColor: '#ffffff',highlightSpotColor: '#bf005f',highlightLineColor: '#ffffff',tooltipSuffix: ' resas',tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{y:val}}',tooltipValueLookups: {names: datestring }});
	    		i++;
	    	});
	    });
	    $.getJSON('/data/stats/weeklystats?type=seats&selectedLocationId='+selectedLocationId,{},function(response){
	    	console.log( response.data );
	    	var j=0;
	    	$.each( response.data, function( key2, value2 ) {
	    		//console.log( "key2", key2 );
	    		//console.log( "value2: ", value2 );
	    		var myvarde2 = [];
	    		var datestring2 ={};
	    		var totalvarde2=0;
	    		var l=0;
	    		$.each( value2, function(nyckel2, varde2){
	    			//console.log( "varde2: ", varde2 );
	    			myvarde2.push( varde2 );
	    			totalvarde2=totalvarde2+varde2;
	    			datestring2[l]=nyckel2;
	    			l++;
	    		});
	    		console.log( 'datestring2: ', datestring2 );
		  		var html2='<div class="col-md-6">'+
					'<div class="panel panel-green">'+
						'<div class="panel-body padding-20 text-center">'+
							'<div class="space10">'+
								'<h5 class="text-white semi-bold no-margin p-b-5">'+key2+'</h5>'+
								'<h1>'+totalvarde2+'</h1>'+
								'Couverts'+
							'</div>'+
							'<div>'+
								'<span class="dynamicsparkline2'+j+'">Loading..</span>'+
							'</div>'+
							'<span class="text-light"><i class="fa fa-clock-o"></i> 1 hour ago</span>'+
						'</div>'+
					'</div>'+
				'</div>';
	    		$('.addsparkline2').append( html2 );
	    		$('.dynamicsparkline2'+j).sparkline(myvarde2, {type: "line", lineColor: '#ffffff', width: "80%", height: "70",fillColor: "", spotRadius: 4,lineWidth: 2,resize: true,spotColor: '#ffffff',minSpotColor: '#ffffff',maxSpotColor: '#ffffff',highlightSpotColor: '#bf005f',highlightLineColor: '#ffffff',tooltipSuffix: ' resas',tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{y:val}}',tooltipValueLookups: {names: datestring2 }});
	    		j++;
	    	});
	    });
	}
    return {
        //main function to initiate template pages
        init: function () {
			loadSparkData();
        }
    };
}();