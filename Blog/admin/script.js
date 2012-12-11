// 
//	jQuery Validate example script
//
//	Prepared by David Cochran
//	
//	Free for your use -- No warranties, no guarantees!
//

    $(function() {
      // Setup drop down menu
      $('.dropdown-toggle').dropdown();
     
      // Fix input element click problem
      $('.dropdown input, .dropdown label').click(function(e) {
        e.stopPropagation();
      });

	// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions
	
		$('#registerHere').validate({
	    rules: {
	      username: {
	        minlength: 5,
	        maxlength:20,
	        required: true
	      },
	      password: {
	        required: true,
	        minlength: 6,
	        maxlength:30
	      },
	      password2: {
	        equalTo: "#password"
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      namalengkap: {
	      	minlength: 4,
	        required: true
	      },
	      telp: {
	        minlength: 10,
	        maxlength:15,
	        required: true,
	        digits:true
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