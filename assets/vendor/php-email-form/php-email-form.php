<?php
class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $ajax;
  private $messages = array();
  public $smtp = false;

  function add_message($content, $label, $length = 0) {
    if (!empty($content)) {
      $this->messages[] = "$label: $content";
    }
  }

  function send() {
    $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n";
    $headers .= 'Reply-To: ' . $this->from_email . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    $message = implode("\n", $this->messages);

    if (mail($this->to, $this->subject, $message, $headers)) {
      return 'OK';
    } else {
      return 'Email sending failed.';
    }
  }
}
?>
