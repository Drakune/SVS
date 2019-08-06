@extends('layouts.app')

@section('content')

<div class="text-center">
	<h1>
		Willkommen, {{ Auth::user()->name }}
		<hr style="border: 1px solid lightgrey;border-style: dashed;color: grey">
	</h1>
</div>

@endsection