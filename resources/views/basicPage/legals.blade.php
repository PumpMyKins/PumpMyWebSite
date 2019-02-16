@extends('layouts.basictemplate')

@section('title')
	Mention Légales
@endsection

@section('content')
	
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="card">
					<div class="img-card">
						<img src="{{ url('https://cdn.discordapp.com/attachments/528996615827226665/529068383518588948/PMK5.jpg') }}" alt="server-image"/>
					</div>
					<div class="card-content">
						<h4 class="card-title">
							<a href="#"> Réglement Intérieurs PumpMyKins.
							</a>
						</h4>
						<p class="description">
							Réglement intérieur de l'association PumpMyKins. Connaissance obligatoire !
					</div>
					<div class="card-read-more">
						<a href="{{ url('legals  ') }}" class="btn btn-link btn-block">
							En savoir plus
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="card">
					<div class="img-card">
						<img src="{{ url('https://cdn.discordapp.com/attachments/528996615827226665/529068901959729152/PMK6.jpg') }}" alt="server-image"/>
					</div>
					<div class="card-content">
						<h4 class="card-title">
							<a href="#"> Conditions générales d'utilisations.
							</a>
						</h4>
						<p class="description">
							Conditions générales d'utilisation des services de l'association PumpMyKins.
						</p>
					</div>
					<div class="card-read-more">
						<a href="{{ url('legals') }}" class="btn btn-link btn-block">
							En savoir plus
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="card">
					<div class="img-card">
						<img src="{{ url('https://cdn.discordapp.com/attachments/528996615827226665/529067377095081984/PMK4.jpg') }}" alt="server-image"/>
					</div>
					<div class="card-content">
						<h4 class="card-title">
							<a href="#"> Conditions générales de vente.
							</a>
						</h4>
						<p class="description">
							Conditions générales de ventes de l'association PumpMyKins.
						</p>
					</div>
					<div class="card-read-more">
						<a href="{{ url('legals') }}" class="btn btn-link btn-block">
							En savoir plus
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection