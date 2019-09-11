@extends('layouts.default', ['title' => __('pumpmykins.forum')])

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 col-lg-2">
			<div class="card">
				<div class="card-header text-center"> 
					<i class="fas fa-chevron-down"></i>
					<a class="text-dark" data-toggle="collapse" href="#generalCollapse" role="button" aria-expanded="true" aria-controls="generalCollapse">
						{{ __('pumpmykins.general') }}
						<i class="fas fa-chevron-down"></i>
					</a>
				</div>
				<div class="collapse expand-sm" id="generalCollapse">
					<div class="card-body text-center">

						<button type="button" class="btn btn-light">{{ __('forum.newpost') }}</button>
						<hr>
						<button type="button" class="btn btn-light"> {{__('forum.draft') }}</button>
						<hr>
						<button type="button" class="btn btn-light"> {{ __('forum.mypost') }}</button>

					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-9 col-lg-8">
			@if(count($posts) != 0)
			@foreach($posts as $post)
			<div class="row">
				<div class="container-fluid">
					<a href="" class="text-dark text-dark-custom">
						<div class="card card-perso">
							<div class="card-header"> {{ Str::limit($post->title,50) }}</div>
							<div class="card-body">
								<p class="card-text"> 
									{!! Str::limit($post->content,290) !!}</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				@endforeach
				@else
				<div class="">
					<div class="card">
						<div class="card-header text-center">
							<i class="far fa-surprise" style="font-size: 1.5rem;"></i> {{ __('forum.Strangely this category is empty !') }} <i class="far fa-surprise" style="font-size: 1.5rem;"></i>
						</div>
						<div class="card-body">
							<p class="card-text text-center">
								{{ __('forum.emptytext') }}
							</p>
						</div>
					</div>
				</div>
				@endif
			</div>
			<div class="col-md-0 col-lg-2">
				<div class="flex-column"> 
					{{ $posts->links('layouts.partials.pagination') }}
				</div>
			</div>
		</div>
	</div>
	
	@stop