// 
//	jQuery Validate example script
//
//	Prepared by David Cochran
//	
//	Free for your use -- No warranties, no guarantees!
//

$(document).ready(function(){

	// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions
	
		$('#registerHere').validate({
	    rules: {
	      idusername: {
	      	minlength:2,
	      	required: true
	      },
	      username: {
	        minlength: 2,
	        required: true
	      },
	      password: {
	        minlength: 3,
	        required: true
	      },
	      namalengkap: {
	      	minlength:5,
	      	required: true
	      },
	      email: {
	        required: true,
	        email: true
	      }
	    },
	    highlight: function(label) {
	    	$(label).closest('.control-group').removeClass('success').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('OK!').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    }
	  });
	  
}); // end document.ready