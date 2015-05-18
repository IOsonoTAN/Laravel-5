<?php
  namespace App\Http\Controllers;
  use Illuminate\Http\Request;

class ContentController extends Controller {

	public function __construct(){
	}

	public function contactUs(){
    return view('contact-us');
  }

  public function contactUsPost(){
    $name = \Request::get('name');
    $message = \Request::get('message');
    $return = [];
    return \Request::file();
    if($name AND $message):
      $return = [
        'success' => true,
        'message' => 'We\'ve received your messages, Thank you.',
      ];
    else:
      $return['success'] = false;
      $return['errors'] = '';
      if(!$name):
        $return['errors'] .= 'You must to enter your name!<br>';
      endif;
      if(!$message):
        $return['errors'] .= 'You must to enter your message!<br>';
      endif;
    endif;
    return $return;
  }

}