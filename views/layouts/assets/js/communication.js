var FormCommunications = function() {"use strict";
	var runCKEditor = function() {
		CKEDITOR.disableAutoInline = true;
		$('textarea.ckeditor').ckeditor();
	};
	return {
		//main function to initiate template pages
		init: function() {
			runCKEditor();
		}
	};
}();