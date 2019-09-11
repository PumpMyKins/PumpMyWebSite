<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">

	    <title>{{ config('app.name', 'PumpMyKins') }} {{ $title ?? '' }}</title>

	    @include('layouts.partials.script')

		</head>
	<body>

		@include('layouts.partials.nav')

		<div class="d-flex flex-column">
			<div class="top">
				<div class="p-3">

					@yield('content')
					
				</div>
			</div>
			@include('layouts.partials.footer')

		</div>
	</body>
</html>