<?php
	function strip_zeros_form_date($marked_string=""){
		// First Remove Marked Zero
		$no_zeros = str_replace('*0', '', $marked_string);

		// Then Removes Any remaining Marks
		$cleaned_string = str_replace('*', '', $no_zeros);
		return $cleaned_string;

	}


	function redirect_to($location == NULL){
		if ($location != NULL) {
			header("location:{$location}");
			exit();
		}

	}

	function output_messages($message=""){
		if (!empty($message)) {
			return "<p class='message'>{$message}</p>";
		}else{
			return "";
		}
	}
?>