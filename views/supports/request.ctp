<?php
    echo $this->Form->create('ContactMessage', array('url' => Router::url('', true) ))."\n".
    echo $this->Form->inputs(
        array(
            'legend' => sprintf(__d('contact_form', 'Send a message to: %s', true), $contact['name']),
            
            'ContactMessage.full_name' => array(
                'label' => __d('contact_form', 'Your name and surname', true),
                'placeholder' => 'Mario Rossi'
            ),
            'ContactMessage.email' => array(
                'label' => __d('contact_form', 'E-mail (for replying)', true),
                'placeholder' => __d('contact_form', 'mario.rossi@gmail.com', true)
            ),
            'ContactMessage.subject' => array(
                'label' => __d('contact_form', 'Subject', true),
                'placeholder' => ''
            ),
            'ContactMessage.body' => array(
                'label' => __d('contact_form', 'Message', true),
                'placeholder' => __d('contact_form', 'Your message..', true)
            ),
        )
    )."\n".
    echo $this->Form->end(__d('contact_form', 'Send', true))."\n";
?>
