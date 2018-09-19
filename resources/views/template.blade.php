<!-- SimpleChat Front-End page template -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>SimpleChat</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- Styling -->
		<link rel="stylesheet" href="/css/style.css">
		@yield('pageCSS')
	</head>
	
	<body class="text-center">
		<div class="content-container d-flex w-100 p-3 mx-auto flex-column clearfix">
			<header class="nav-bar">
				<div class="inner">
					<h3 class="brand"><a href="/">SimpleChat</a></h3>
					<nav class="nav nav-links justify-content-center">
						<a class="nav-link" href="/about">About</a>
						<a class="nav-link" href="/contact">Contact</a>
					</nav>
				</div>
			</header>

			<main role="main" class="clearfix">
				@yield('content')
			</main>
		</div>
		<footer class="foot">
			<p class="footer-text">This site is an example of a small <a href="https://laravel.com">Laravel</a> application.<br><span class="anticopy">&copy;</span> Matthew Fritter, 2018</p>
		</footer>
		
		<!-- Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>
