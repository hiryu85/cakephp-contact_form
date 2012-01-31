<?php
 /**
  * Contact_form plugin configurations
  *
  * Create new address: append to array $config['ContactForm']['mail'] an array like this:
  * 
  *     array(
  *         'slug-name' => array(
  *              // Address
  *              'name' => 'Name and surname',   # REQUIRED 
  *              'address' => 'your-email'       # REQUIRED
  *              // Subject
  *              'prefix' => 'Webmaster'         # OPTIONAL: Subject prefix,
  *              'subject' => 'Info abaout'      # OPTIONAL: Subject text
  *         )
  *     )
  *
  * All OPTIONAL fields can be not sets.
  * 
  */




// Webmaster address
$config['ContactForm']['mail']['webmaster'] = array(
        // Address
        'name' => 'Foo bar',             # REQUIRED
        'address' => 'foo@bar.org'       # REQUIRED,
        
        // Subject
        'prefix' => 'Webmaster'         # OPTIONAL: Subject prefix,
        'subject' => 'Info abaout'      # OPTIONAL: Subject text
);


// Info address
$config['ContactForm']['mail']['supports'] = array(
        // Address
        'name' => 'Supports team',
        'address' => 'support'
        // Subject
        'prefix' => 'Info'                      # OPTIONAL: Subject prefix,
        'subject' => 'I need help, please'      # OPTIONAL: Subject text
);
