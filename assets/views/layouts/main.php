<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PC4U Webshop</title>
		<!-- Font-Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- MaterializeCss -->
		<link rel="stylesheet" href="/css/materialize.css">
		<link rel="stylesheet" href="/css/snackbarlight.min.css">

		<style type="text/css">
			#app {
			    display: flex;
			    min-height: 100vh;
			    flex-direction: column;
			}

			.view {
				flex: 1 0 auto;
			}
			.turn-enter {
				animation: turn-in .5s;
			}
			.turn-leave {
				animation: turn-out .75s;
			}
			@keyframes turn-in {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}
			@keyframes turn-out {
				0% {
				    opacity: 1;
				}
				100% {
				    opacity: 0;
				}
			}
		</style>
	</head>
	<body>

		<div id="app">
			<?php $view->yieldSection("content") ?>
			<router-view class="view" transition="turn" transition-mode="out-in"></router-view>

			<footer class="page-footer">
	          	<div class="footer-copyright">
	            	<div class="container">
		            	© Copyright Joost Lawerman
		            </div>
		        </div>
	        </footer>
		</div>

		<!-- Main Vuejs complied script -->
		<script type="text/javascript" src="/js/main.js"></script>

		<!-- Jquery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	  	<!-- MaterializeJs -->
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
	</body>
</html>

