<?php
class ContactMessage extends ContactFormAppModel {
    const BODY_MIN_WORDS = 5;  // TODO: Configuration
    
    var $name = 'ContactMessage';
    var $useTable = false;
    var $_schema = array(
        'full_name' => array('type' => 'string'),
        'email' => array('type' => 'string'),
        'subject' => array('type' => 'string', 'length' => 32, 'default' => '-'),
        'body' => array('type' => 'text'),
    );


    function __construct( $id = false, $table = NULL, $ds = NULL ) {
        parent::__construct($id, $table, $ds);
        $this->validate['email']['invalid_address'] = array( 
            'rule' => 'email',
            'message' => __d('contact_form', 'This address don\'t seems a valid e-mail.', true),
            'required' => true,
            'allowEmpty' => false,
        );
        
        $min_words = 5;
        $this->validate['body']['to_short_message'] = array( 
            'rule' => array('wordCounters', $min_words),
            'message' => sprintf(__d('contact_form', 'Message too short (%d words minimium)', true), $min_words),
            'required' => true,
            'allowEmpty' => false,
        );
    }
     

    /* Customs Validators */
    function wordCounters($field, $number) {
        $words = explode(' ', current($field));
        return sizeof($words) >= $number;
    }

}
