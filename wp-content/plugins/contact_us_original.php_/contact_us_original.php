<?php
/*
Plugin Name: DannyForm
Plugin URI: https://www.youtube.com/watch?v=dQw4w9WgXcQ
Description: Contact Form The Win. Sup this is Danny in the server. 
Version: 1.0
Author: Danny Shafer
Author URI: http://dannyshafer.github.io
*/



if (function_exists('add_action')) {
    add_action('admin_menu', 'test_plugin_setup_menu');
    include 'placeholderFunctions.php';
}
 
function test_plugin_setup_menu(){
        add_menu_page( 'DANNYFORM', 'DANNYFORM', 'manage_options', 'contact_us', 'test_init' );
}
 
function test_init(){
        echo "<h1>Welcome to DannyForm, the de facto method of getting in touch with Jews for Jesus!</h1>";
        echo '<p>The contact form can be accessed via this shortcode with options:</p>';
        echo '<h3>[danny_contact_form form_title=\' \' form_intro=\' \' form_recipient=\' \' form_thank_you=\' \']</h3>';
        echo '<p>When calling the form, fill each of the four options with the appropriate title, introduction, recipient e-mail address, and thank you message information so that the form will be generated properly. The plugin can also be called without parameters using the following:</p>';
        echo '<h3>[danny_contact_form]</h3>';
        echo '<p>Doing so will result in a form with the title "Contact Us", the intro "PLZ CONTACT US VIA THIS FORM", a recipient of Daniel.Shafer@JewsForJesus.org and a thank you message of "Thanks for contacting me, expect a response soon."</p>';
        echo '<p>You can always access existing shortcodes by clicking on the "Tables Lookup" link on the side bar and selecting the wp_contact_shortcodes table.</p>';
        echo 'Then access that preset with the following and place the name of the shortcode between the single quotes:';
        echo '<h3>[danny_contact_form form_shortcode=\'\']</h3>';
        echo '<h2>Create a new shortcode</h2>';
        echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
        echo '<p>';
        echo 'Shortcode name (must be one word or multiple words with snake_case) <br/>';
        echo '<input type="text" name="cf-shortcode_name" value="' . ( isset( $_POST["cf-shortcode_name"] ) ? esc_attr( $_POST["cf-shortcode_name"] ) : '' ) . '" size="40" required/>';
        echo '</p>';
        echo 'Recipient Email Address (i.e. "Daniel.Shafer@JewsForJesus.org")<br/>';
        echo '<input type="text" name="cf-shortcode_recipient" value="' . ( isset( $_POST["cf-shortcode_recipient"] ) ? esc_attr( $_POST["cf-shortcode_recipient"] ) : '' ) . '" size="40" required/>';
        echo '</p>';
        echo 'Form Title <br/>';
        echo '<input type="text" name="cf-shortcode_title" value="' . ( isset( $_POST["cf-shortcode_title"] ) ? esc_attr( $_POST["cf-shortcode_title"] ) : '' ) . '" size="40" required/>';
        echo '</p>';
        echo '<p>';
        echo 'Intro <br/>';
        echo '<input type="text" name="cf-shortcode_intro" value="' . ( isset( $_POST["cf-shortcode_intro"] ) ? esc_attr( $_POST["cf-shortcode_intro"] ) : '' ) . '" size="40" required/>';
        echo '</p>';
        echo '<p>';
        echo 'Thank You Message <br/>';
        echo '<textarea rows="10" cols="35" name="cf-shortcode_thank_you_message" required>' . ( isset( $_POST["cf-shortcode_thank_you_message"] ) ? esc_attr( $_POST["cf-shortcode_thank_you_message"] ) : '' ) . '</textarea>';
        echo '</p>';
        echo '<br>';
        echo '<p><input type="submit" name="cf-add-form" value="Add Shortcode"></p>';
        echo '</form>';
            if ( isset( $_POST['cf-add-form'] ) ) {

            $shortcode_name    = $_POST["cf-shortcode_name"];
            $shortcode_recipient    = $_POST["cf-shortcode_recipient"];
            $shortcode_title = $_POST["cf-shortcode_title"];
            $shortcode_intro = $_POST["cf-shortcode_intro"];
            $shortcode_thank_you_message = $_POST["cf-shortcode_thank_you_message"];

            echo '<h1>Good job! To access the form you just made, you can use the following shortcode: [danny_contact_form form_shortcode=\'' . $shortcode_name . '\']</h1>';

            global $wpdb;
            $wpdb->insert('wp_contact_shortcodes', array('name' => $shortcode_name, 'recipient' => $shortcode_recipient, 'title' => $shortcode_title, 'intro' => $shortcode_intro, 'thank_you' => $shortcode_thank_you_message));
    }
    return "made it to the end of the function";
}

function cf_shortcode( $params ) {
    global $wpdb;
    $taken_params = shortcode_atts( array(
        'form_shortcode' => '',
        'form_title' => 'Contact Us',
        'form_intro' => 'PLZ CONTACT US VIA THIS FORM',
        'form_recipient' => 'daniel.shafer@jewsforjesus.org',
        'form_thank_you' => 'Thanks for contacting me, expect a response soon.',
        ), $params );
    if ( $taken_params[ 'form_shortcode' ] != '' ) {
        $db_results = $wpdb->get_row( "SELECT * FROM wp_contact_shortcodes WHERE name = '". $taken_params[ 'form_shortcode' ] ."'", ARRAY_A  );
        $taken_params[ 'form_recipient' ] = $db_results['recipient'];
        $taken_params[ 'form_title' ] = $db_results['title'];
        $taken_params[ 'form_intro' ] = $db_results['intro'];
        $taken_params[ 'form_thank_you' ] = $db_results['thank_you'];
    }
    ob_start(); 
    deliver_mail( $taken_params[ 'form_thank_you' ], $taken_params[ 'form_recipient' ] ); 
    html_form_code( $taken_params[ 'form_title' ], $taken_params[ 'form_intro' ] ); 

    return ob_get_clean();
}

function html_form_code( $title, $intro) {
    echo '<script type="javascript">';
    echo 'function checkEmail() {';
    echo '    var email = document.getElementById("txtEmail");';
    echo '    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;';
    echo '    if (!filter.test(email.value)) {';
    echo '    alert("Please provide a valid email address");';
    echo '    email.focus;';
    echo '    return false;';
    echo ' }';
    echo '</script>';
    echo '<h1>' . $title . '</h1>';
    echo '<h4>' . $intro . '</h4>';
    echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    echo '<p>';
    echo 'Your First Name (required) <br/>';
    echo '<input type="text" name="cf-firstname" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-firstname"] ) ? esc_attr( $_POST["cf-firstname"] ) : '' ) . '" size="40" required/>';
    echo '</p>';
    echo 'Your Last Name (required) <br/>';
    echo '<input type="text" name="cf-lastname" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-lastname"] ) ? esc_attr( $_POST["cf-lastname"] ) : '' ) . '" size="40" required/>';
    echo '</p>';
    echo 'Your Email (required) <br/>';
    echo '<input type="email" name="cf-email" id="txtEmail" onblur="checkEmail();" pattern="^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" required/>';
    echo '</p>';
    echo '<p>';
    echo 'Subject (required) <br/>';
    echo '<input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40" required/>';
    echo '</p>';
    echo '<p>';
    echo 'Your Message (required) <br/>';
    echo '<textarea rows="10" cols="35" name="cf-message" required>' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
    echo '</p>';
    if ( function_exists('gglcptch_display')) {
        echo gglcptch_display();
    }
    echo '<br>';
    echo '<p><input type="submit" name="cf-submitted" value="Send"></p>';
    echo '</form>';
    return 'made it to the end of the function';
}

function deliver_mail( $thank_you, $recipient) {
    // if the submit button is clicked, send the email
    if ( isset( $_POST['cf-submitted'] ) ) {

        // sanitize form values
        $firstname    = sanitize_text_field( $_POST["cf-firstname"] );
        $lastname    = sanitize_text_field( $_POST["cf-lastname"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        $subject = sanitize_text_field( $_POST["cf-subject"] );
        $message = esc_textarea( $_POST["cf-message"] );

        save_to_db();
        // get the blog administrator's email address
        $to = $recipient;

        $headers = "From: $firstname <$email>" . "\r\n";

        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            echo '<div>';
            echo '<p>' .  $thank_you . '</p>';
            echo '</div>';
        } else {
            echo 'An unexpected error occurred';
        }
    }
}

function save_to_db() {
    $firstname    = sanitize_text_field( $_POST["cf-firstname"] );
    $lastname    = sanitize_text_field( $_POST["cf-lastname"] );
    $email   = sanitize_email( $_POST["cf-email"] );
    $subject = sanitize_text_field( $_POST["cf-subject"] );
    $message = esc_textarea( $_POST["cf-message"] );
    global $wpdb;
    $wpdb->insert('wp_contact_submissions', array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'subject' => $subject, 'body' => $message));
}

if (function_exists('add_shortcode')) {
    add_shortcode( 'danny_contact_form', 'cf_shortcode' );
}


class Example
{
    public function render()
    {
        return 'Hello World';
    }
}

?>