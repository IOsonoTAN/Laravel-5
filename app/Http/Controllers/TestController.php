<?php namespace App\Http\Controllers;

class TestController extends Controller {

	public function __construct(){
	}

	public function index(){
		return view('index');
	}

}