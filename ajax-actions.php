<?php 




// Save questions
add_action( 'wp_ajax_save_questions', 'save_questions' );
add_action( 'wp_ajax_nopriv_save_questions', 'save_questions' );

function save_questions() {
    global $wpdb;

    $formdata = [];
    wp_parse_str($_POST['formData'], $formdata);

    // Extract values from the formdata
    $dropdown1Value = intval($formdata['dropdown1Value']); 
    $followCheck1Value = $formdata['followCheck1Value'];
    $followCheck2Value = $formdata['followCheck2Value'];
    $get_doctors = $formdata['get_doctors']; 
    $qustn_num = $formdata['qustn_num']; 
    $qstn_code =   $dropdown1Value.'_'.$followCheck1Value.'_'.$followCheck2Value;
    $table_name = $wpdb->prefix . 'fitness_question_employee';



    // print_r($qstn_code) ; 

    // Check if a record with the same qstn_code exists
    $existing_record = $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $table_name WHERE qstn_code = %s", $qstn_code)
    );

    if ($existing_record) {
        // Handle the case where a duplicate qstn_code exists (e.g., display an error message)
        wp_send_json_error('Duplicate qstn_code found');
    } else {
        // Prepare the data to insert
        $data_to_insert = array(
            'q_id' => $dropdown1Value,
            'f1_chk1' => $followCheck1Value,
            'f2_chk2' => $followCheck2Value,
            'selected_doc' => $get_doctors,
            'qstn_code' => $qstn_code,
            'qustn_num' => $qustn_num,                            
        );

        // Insert data into the database
        $wpdb->insert($table_name, $data_to_insert);

        // Respond to the AJAX request
        wp_send_json_success('Questions Saved Successfully');
    }
}






// Make  active members
add_action( 'wp_ajax_make_inactive', 'make_inactive' );
add_action( 'wp_ajax_nopriv_make_inactive', 'make_inactive' );
function make_inactive(){

    // print_r($_POST['formData']) ; 
    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
    $wpdb->update( $table_name, array('status' => '2') , array('id' => $member_id), '', '' );
  wp_die();

}




// approve member 
add_action( 'wp_ajax_approve_member', 'approve_member' );
add_action( 'wp_ajax_nopriv_approve_member', 'approve_member' );
function approve_member(){

    // print_r($_POST['formData']) ; 
    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
  
  $wpdb->update( $table_name, array('status' => '3') , array('id' => $member_id), '', '' );
  // Sanitize and prepare the form data
  wp_die();

}



// reject member 
add_action( 'wp_ajax_reject_member', 'reject_member' );
add_action( 'wp_ajax_nopriv_reject_member', 'reject_member' );
function reject_member(){

    // print_r($_POST['formData']) ; 
    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
  
  $wpdb->update( $table_name, array('status' => '4') , array('id' => $member_id), '', '' );
  // Sanitize and prepare the form data
  wp_die();

}

// inactive member 
add_action( 'wp_ajax_inactive_member', 'inactive_member' );
add_action( 'wp_ajax_nopriv_inactive_member', 'inactive_member' );
function inactive_member(){

    global $wpdb;
    $member_id = $_POST['formData'] ; 
    $table_name = $wpdb->prefix . 'boc_registration_form';
    $wpdb->update( $table_name, array('status' => '2') , array('id' => $member_id), '', '' );
  // Sanitize and prepare the form data

  wp_die();

}


?>