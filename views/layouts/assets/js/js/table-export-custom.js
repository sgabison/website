var TableExport = function() {
	"use strict";
	//function to initiate HTML Table Export
	var runTableExportTools = function() {
		$(".export-pdf").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'pdf',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:12,
				pdfLeftMargin:0,
				escape:'false', // si false remplace url_encode
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-png").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'png',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-excel").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'excel',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-doc").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'doc',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-powerpoint").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'powerpoint',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-csv").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'csv',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-txt").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'txt',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-xml").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'xml',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-sql").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'sql',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
		$(".export-json").on("click", function(e) {
			e.preventDefault();
			var exportTable = $(this).data("table");
			var ignoreColumn = $(this).data("ignorecolumn");
			$(exportTable).tableExport({
				type: 'json',
				ignoreColumn: '['+ignoreColumn+']',
				separator: ';',
				tableName:'yourTableName',
				pdfFontSize:14,
				pdfLeftMargin:20,
				escape:'false',
				htmlContent:'false',
				consoleLog:'false' 
			});
		});
	};
	 var printTable= function( ){
	  var PIMCORE_WEBSITE_LAYOUTS = "http://demo.gabison.com/website/views/layouts/";
		$('.print-table').on('click',function(e){
		 
		   var div = $( $(this).data("table") ); 
		   div.addClass("print-table");
		   var divToPrint= div[0].outerHTML;
		   var printWindow= window.open("");

		printWindow.document.write('<html><head >');
//		printWindow.document.write('<link href="http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800" rel="stylesheet" type="text/css"> ' );
 		printWindow.document.write('<link rel="stylesheet" type="text/css" media="all" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/bootstrap/css/bootstrap.min.css"> ' ); 
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/font-awesome/css/font-awesome.min.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/iCheck/skins/all.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/summernote/dist/summernote.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css"> ' );
 		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/bootstrap-select/bootstrap-select.min.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css"> ' );
 		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/DataTables/media/css/DT_bootstrap.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" type="text/css" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/select2/select2.css" />' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/plugins/bootstrap-social-buttons/bootstrap-social.css"> ' );

		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/css/styles.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/css/styles-responsive.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/css/plugins.css"> ' );
//		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/css/themes/theme-style8.css" type="text/css" id="skin_color"> ' );
//
		printWindow.document.write('<link rel="stylesheet" href="'+  PIMCORE_WEBSITE_LAYOUTS + '/assets/css/print.css" type="text/css" media="print"/>' );

		printWindow.document.write('</head><body >');
		printWindow.document.write(divToPrint);
		printWindow.document.write('</body></html>');
// 			printWindow.print();
// 			printWindow.close();
		}	);
	 };
	
	return {
		//main function to initiate template pages
		init : function() {
			runTableExportTools();
			printTable();
		}
	};
}();
