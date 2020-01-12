<!DOCTYPE html>
<html lang="ru">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>СПТ-941</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- Bulma css. Font-awesome + main.css --}}
        <link rel="stylesheet" href="/css/app.css">
        {{-- Icons --}}
        <link rel="icon" sizes="32x32" ref="/img/favicon.png" type="image/png">
        {{-- Additional libraries or css code --}}
        @yield('libraries')
	</head>

	<body>
		<section class="section">
			<div class="container">
				<div class="columns">
					{{-- Main navigation --}}
                    @include('layouts.aside')
					<div class="column is-9 main-content">
                        {{-- Main content --}}
                        @yield('content')
					</div>
				</div>
			</div>
		</section>
		<footer class="footer">
			<div class="columns is-mobile is-centered">
				<div class="columns is-mobile is-centered">
					<p class="creator"><span class="icon is-small is-left">
							<i class="fa fa-copyright"></i>
						</span>
						made by Mishin Alexey</p>
				</div>
			</div>
		</footer>
    </body>
	{{-- Additional scripts --}}
	@yield('scripts')
</html>
