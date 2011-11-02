<?php 
class SupportsController extends ContactFormAppController {
    var $name = 'Supports';
    var $components = array('Email');
    var $uses = array('ContactForm.ContactMessage');
    
    function beforeFilter() {
        parent::beforeFilter();
        
        // Override here EmailComponent options
        $this->Email->layout = 'foo';
        $this->Email->sendAs = 'text';
    }
     
    function request($to=NULL) {
        $this->set('pageTitle', __d('contact_form', 'Send a message', true));

        // Load configurations
        Configure::load('ContactForm.address');
        $slug = Inflector::slug($to);
        $addressLists = Configure::read('ContactForm.mail');    
                    
        if (!is_array($addressLists) || $addressLists == NULL) {
            $this->log('No file named plugins/contact_form/config/address.php or empty file', 'ContactFormPlugin');
            return;
        } elseif ($to == NULL) {
            reset($addressLists); // make sure array pointer is at first element 
            $slug = Inflector::slug(key($addressLists));
        } elseif(!isset($addressLists[$slug]['address'])) {
            $this->log('No slug named '.$slug. 'into plugins/contact_form/config/address.php', 'ContactFormPlugin');
            return;
        }
        $this->set('contact', $addressLists[$slug]);

        if (empty($this->data)) return;
        $this->ContactMessage->create($this->data);
        if (!$this->ContactMessage->validates()) return;
                    
        $full_name = $this->data['ContactMessage']['full_name'];
        $email = $this->data['ContactMessage']['email'];
        
        $this->Email->to = $addressLists[$slug]['address'];        
        $this->Email->from = sprintf('%s <%s>', $full_name, $email);
        $this->Email->subject = sprintf(
            '[%s] %s', 
            (!empty($addressLists[$slug]['prefix']) ? $addressLists[$slug]['prefix'] : 'ContactForm'),
            $this->data['ContactMessage']['subject']
        );
        $this->Email->headers = array(
            'X-Mailer-Host' => Router::url('/', true),
            'X-Mailer-Location' => Router::url('', true)
        );
        
        $this->set('to', $addressLists[$slug]);
        $this->set('from', compact('full_name', 'email'));
        $this->set('host', Router::url('/', true));

        if ($this->Email->send($this->data['ContactMessage']['body'], null, 'default')) 
            $this->Session->setFlash(__d('contact_form', 'Message has been sent.. Thank You', true), 'flash_success');
        else
             $this->Session->setFlash(__d('contact_form', 'Message cannnot be sent to '.$addressLists[$slug]['address'], true), 'flash_failure');

        $this->redirect($this->referer('/'));
   }
}
?>
