<?php
function cookieCheck($sessionname){
	if(isset($_COOKIE[$sessionname])){
		session_id($_COOKIE[$sessionname]);
	}
}