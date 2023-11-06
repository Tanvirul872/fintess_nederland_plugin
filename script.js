
jQuery(document).ready(function($){

//frontent registration form 

$('#boc_registration').submit(function (event) {
    event.preventDefault();
  
    alert('boc_registration')  

  var password = $('#password').val();
  var confirmPassword = $('#confirm_password').val();

  if (password !== confirmPassword) {
    alert('Password does not match!');
    return; // Prevent form submission
  }else{ 
    
    var ajax_url = plugin_ajax_object.ajax_url;     
    // Get the educational certificate files
  
    var form = $('#boc_registration').serialize();

    var formData = new FormData ;  
    formData.append('action','boc_registration_data') ;;
    formData.append('signature_img', jQuery('#signature_img')[0].files[0]); 
    formData.append('nid_image', jQuery('#nid_image')[0].files[0]);  
    formData.append('personal_img', jQuery('#personal_img')[0].files[0]);  
       
    var eduCertificates = $('.edu_certificate');
    // Loop through each educational certificate file input field
    for (var i = 0; i < eduCertificates.length; i++) {
        var files = eduCertificates[i].files;
        // Loop through each selected file for the current educational certificate
        for (var j = 0; j < files.length; j++) {
        formData.append('edu_certificate[]', files[j]);
        }
    } 

    formData.append('boc_registration_data', form ) ;

    $.ajax({
        url: ajax_url,
        data: formData,
        processData:false,
            contentType:false,
            type:'post',
        // data: data,
        
        success: function(response){
          alert('successfully store data') ; 

          window.location.href = response;
      
          $("#sslcomerze-pay").removeAttr("style");
          $("#sslcomerze-pay").attr("href", response);
          $("manual_submit").attr('disabled');
            

        }
    });
  }     
  
});




// Approve question 
$('.save_questions').click(function (event) {
  event.preventDefault();

  var $row = $(this).closest('.accordion-item'); // Get the closest parent row

  var dropdown1Value = $row.find('#dropdown1').val();
  var followCheck1Value = $row.find('#followCheck1').val();
  var followCheck2Value = $row.find('#followCheck2').val();
  var get_doctors = $row.find('#get_doctors').val();
  var qustn_num = $(this).attr('value');


//  alert(btnvalue) ;  

    var formData =   
         "dropdown1Value="+dropdown1Value+
          "&followCheck1Value="+followCheck1Value+
          "&followCheck2Value="+followCheck2Value+
          "&qustn_num="+qustn_num+
          "&get_doctors="+get_doctors ; 
      
          // alert('hello222') ; 


  var ajax_url = plugin_ajax_object.ajax_url;
  var data = {
      'action': 'save_questions',
      'formData': formData
  };

  $.ajax({
      url: ajax_url,
      type: 'post',
      data: data,
      success: function(response){
          alert('Questions Saved Successfully');
          // location.reload();
      }
  });
});




// accordion javascript 
$('.accordion-header').click(function() {  
    const content = $(this).next('.accordion-content');
    content.slideToggle();
});





});





