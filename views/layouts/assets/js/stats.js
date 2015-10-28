var StatisticsForm = function () {
	"use strict";
	var mydata = [];
	var selectedLocationId=$('#selectedLocationId').val();
	var loadSparkData = function(){
	    $.getJSON('/data/stats/weeklystats?type=order&timeline=past&selectedLocationId='+selectedLocationId,{},function(response){
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
									t('js_orders') + '<br>'+ t('js_last_seven') +
								'</div>'+
								'<div>'+
									'<span class="dynamicsparkline'+i+'">Loading..</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
	    		$('.addsparkline').append( html1 );
	    		$('.dynamicsparkline'+i).sparkline(myvarde, {type: "line", lineColor: '#ffffff', width: "80%", height: "70",fillColor: "", spotRadius: 4,lineWidth: 2,resize: true,spotColor: '#ffffff',minSpotColor: '#ffffff',maxSpotColor: '#ffffff',highlightSpotColor: '#bf005f',highlightLineColor: '#ffffff',tooltipSuffix: ' resas',tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{y:val}}',tooltipValueLookups: {names: datestring }});
	    		i++;
	    	});
	    });
	    $.getJSON('/data/stats/weeklystats?type=seats&timeline=past&selectedLocationId='+selectedLocationId,{},function(response){
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
					'<div class="panel panel-blue">'+
						'<div class="panel-body padding-20 text-center">'+
							'<div class="space10">'+
								'<h5 class="text-white semi-bold no-margin p-b-5">'+key2+'</h5>'+
								'<h1>'+totalvarde2+'</h1>'+
								t('js_seats') + '<br>'+ t('js_last_seven') +
							'</div>'+
							'<div>'+
								'<span class="dynamicsparkline2'+j+'">Loading..</span>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>';
	    		$('.addsparkline2').append( html2 );
	    		$('.dynamicsparkline2'+j).sparkline(myvarde2, {type: "line", lineColor: '#ffffff', width: "80%", height: "70",fillColor: "", spotRadius: 4,lineWidth: 2,resize: true,spotColor: '#ffffff',minSpotColor: '#ffffff',maxSpotColor: '#ffffff',highlightSpotColor: '#bf005f',highlightLineColor: '#ffffff',tooltipSuffix: ' resas',tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{y:val}}',tooltipValueLookups: {names: datestring2 }});
	    		j++;
	    	});
	    });
	    $.getJSON('/data/stats/weeklystats?type=orderss&timeline=future&selectedLocationId='+selectedLocationId,{},function(response){
	    	console.log( response.data );
	    	var j=0;
	    	$.each( response.data, function( key3, value3 ) {
	    		//console.log( "key3", key3 );
	    		//console.log( "value3: ", value3 );
	    		var myvarde3 = [];
	    		var datestring3 ={};
	    		var totalvarde3=0;
	    		var l=0;
	    		$.each( value3, function(nyckel3, varde3){
	    			//console.log( "varde3: ", varde3 );
	    			myvarde3.push( varde3 );
	    			totalvarde3=totalvarde3+varde3;
	    			datestring3[l]=nyckel3;
	    			l++;
	    		});
	    		console.log( 'datestring3: ', datestring3 );
		  		var html3='<div class="col-md-6">'+
					'<div class="panel panel-green">'+
						'<div class="panel-body padding-20 text-center">'+
							'<div class="space10">'+
								'<h5 class="text-white semi-bold no-margin p-b-5">'+key3+'</h5>'+
								'<h1>'+totalvarde3+'</h1>'+
								t('js_orders') + '<br>'+ t('js_next_seven') +
							'</div>'+
							'<div>'+
								'<span class="dynamicsparkline3'+j+'">Loading..</span>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>';
	    		$('.addsparkline3').append( html3 );
	    		$('.dynamicsparkline3'+j).sparkline(myvarde3, {type: "line", lineColor: '#ffffff', width: "80%", height: "70",fillColor: "", spotRadius: 4,lineWidth: 2,resize: true,spotColor: '#ffffff',minSpotColor: '#ffffff',maxSpotColor: '#ffffff',highlightSpotColor: '#bf005f',highlightLineColor: '#ffffff',tooltipSuffix: ' resas',tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{y:val}}',tooltipValueLookups: {names: datestring3 }});
	    		j++;
	    	});
	    });
	    $.getJSON('/data/stats/weeklystats?type=seats&timeline=future&selectedLocationId='+selectedLocationId,{},function(response){
	    	console.log( response.data );
	    	var j=0;
	    	$.each( response.data, function( key4, value4 ) {
	    		//console.log( "key4", key4 );
	    		//console.log( "value4: ", value4 );
	    		var myvarde4 = [];
	    		var datestring4 ={};
	    		var totalvarde4=0;
	    		var l=0;
	    		$.each( value4, function(nyckel4, varde4){
	    			//console.log( "varde3: ", varde3 );
	    			myvarde4.push( varde4 );
	    			totalvarde4=totalvarde4+varde4;
	    			datestring4[l]=nyckel4;
	    			l++;
	    		});
	    		console.log( 'datestring4: ', datestring4 );
		  		var html4='<div class="col-md-6">'+
					'<div class="panel panel-green">'+
						'<div class="panel-body padding-20 text-center">'+
							'<div class="space10">'+
								'<h5 class="text-white semi-bold no-margin p-b-5">'+key4+'</h5>'+
								'<h1>'+totalvarde4+'</h1>'+
								t('js_seats') + '<br>'+ t('js_next_seven') +
							'</div>'+
							'<div>'+
								'<span class="dynamicsparkline4'+j+'">Loading..</span>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>';
	    		$('.addsparkline4').append( html4 );
	    		$('.dynamicsparkline4'+j).sparkline(myvarde4, {type: "line", lineColor: '#ffffff', width: "80%", height: "70",fillColor: "", spotRadius: 4,lineWidth: 2,resize: true,spotColor: '#ffffff',minSpotColor: '#ffffff',maxSpotColor: '#ffffff',highlightSpotColor: '#bf005f',highlightLineColor: '#ffffff',tooltipSuffix: ' resas',tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{y:val}}',tooltipValueLookups: {names: datestring4 }});
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