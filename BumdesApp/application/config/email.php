<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.gmail.com', 
    'smtp_port' => 587,
    'smtp_user' => 'sistemwebbumdij@gmail.com',
    'smtp_pass' => 'BUMDesindrakila2020wsa',
    'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE,
    'crlf'    => "\r\n",
    'newline' => "\r\n"
];