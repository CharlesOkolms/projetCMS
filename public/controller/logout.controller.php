<?php

if ( !empty(CURRENT_ACTION) && CURRENT_ACTION === 'logout' ) {
	if ( !empty(CURRENT_USER_ID) ) {
		unset($_SESSION['user']);
		session_unset();
	}
	goToPage('accueil');
}
