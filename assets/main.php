<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style>
			.loader {
		        height: 4px;
		        width: 100%;
		        position: fixed;
		        overflow: hidden;
		        background-color: #ddd;
		        top: 0px;
		    }
		    .loader:before{
		        display: block;
		        position: absolute;
		        content: "";
		        left: -200px;
		        width: 200px;
		        height: 4px;
		        background-color: #2980b9;
		        animation: loading 2s linear infinite;
		    }

		    @keyframes loading {
		        from {left: -200px; width: 30%;}
		        50% {width: 30%;}
		        70% {width: 70%;}
		        80% { left: 50%;}
		        95% {left: 120%;}
		        to {left: 100%;}
		    }
		</style> 
	</head>
	<body>
		<div id="app"></div>
		<script type="text/javascript" src="/js/main.js"></script>
	</body>
</html>