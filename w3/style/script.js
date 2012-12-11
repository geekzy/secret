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
	
		$('#registhere').validate({
	    rules:{
	      inputusername: {
	        minlength: 5,
	        required: true
	      },
	      inputpassword: {
	        minlength: 5,
	        required: true
	      },
	      inputnama: {
	        minlength: 5,
	        required: true
	      },
	      inputemail: {
	        required: true,
	        email: true
	      },
	      inputtelephone: {
	      	minlength: 5,
	        required: true
	      }

	     
	    },
	    highlight: function(label) {
	    	$(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('OK!').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    }
	  });
	  
}); // end document.ready