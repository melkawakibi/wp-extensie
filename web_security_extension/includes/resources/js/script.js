jQuery('#btn-toggle').click(function(){
	jQuery('#form-container').slideToggle();
});

jQuery('.email-wrapper').hide();

jQuery( '#email' )
  .change(function () {
  	val = jQuery(this).find("option:selected").val();
  	
  	if(val == 'alt-email'){

  		jQuery('.email-wrapper').show()

  	}else{
  		jQuery('.email-wrapper').hide();
  	}

  })
