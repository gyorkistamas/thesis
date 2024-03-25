@auth
	@foreach ($terms as $term)
		@if (! $term->active())
			<h1>{{$term->name}}</h1>
		@endif
	@endforeach
@endauth