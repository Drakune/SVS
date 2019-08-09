@extends('layouts.app')
@section('content')

<div class="text-center">
	<h1>Willkommen in der Schlüsselrechteverwaltung!</h1>
	<hr style="border: 1px solid lightgrey;border-style: dashed;color: grey">
	@foreach($user as $userItem)
		{{ $userItem->name }}
	@endforeach
</div>
	

@endsection