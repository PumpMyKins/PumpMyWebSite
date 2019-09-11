<nav class="navbar navbar-expand-md navbar-light shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'PumpMyKins') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				
				<li class="nav-item">
					<a class="nav-link" href=""> {{ __('pumpmykins.server') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href=""> {{ __('pumpmykins.rules') }}</a>
				</li>
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						{{ __('pumpmykins.forum') }}
					</a>
					<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdown">
						<a href="{{ route('general') }}" class="dropdown-item">
							{{ __('pumpmykins.general') }}
						</a>
						<a href="{{ route('tutorial') }}" class="dropdown-item">
							{{ __('pumpmykins.tutorial') }}
						</a>
						<a href="" class="dropdown-item">
							{{ __('pumpmykins.support') }}
						</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href=""> {{ __('pumpmykins.discord') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://store.pumpmykins.eu"> {{ __('pumpmykins.shop') }}</a>
				</li>

			</ul>
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}">{{ __('pumpmykins.login') }}</a>
				</li>
				@if (Route::has('register'))
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register') }}">{{ __('pumpmykins.register') }}</a>
				</li>
				@endif
				@else
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<img class="img" style="width:1.5em;" src="https://minotar.net/helm/{{ Auth::user()->name }}/100.png">
						{{ Auth::user()->username }}
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">
						<a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{ __('pumpmykins.logout') }}
						</a>
						<a href="{{ route('home') }}" class="dropdown-item">
							{{ __('pumpmykins.panel') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>