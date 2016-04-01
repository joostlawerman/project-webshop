<?php

function incl($location) {
	require __DIR__ . "/../assets/views/" . implode("/", explode(".",$location)) . ".php";
}

function container() {
	
}

