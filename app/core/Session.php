<?php


class Session{

	public static function handleSession(){
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}
}