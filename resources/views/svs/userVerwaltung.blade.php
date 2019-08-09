@extends('layouts.app')

@section('content')

<div class="text-center">
	<h1>
		Willkommen in der Benutzerverwaltung!
		<hr style="border: 1px solid lightgrey;border-style: dashed;color: grey">
	</h1>
	<div>
		@if($userCheck->where('name',Auth::user()->name)->value('role') == 'admin')
			<h2>
				<u>Alle Benutzer:
				</u>
			</h2>
			<h4>
				<table class="table">
					<tr><th><u>ID</u></th><th><u>Name</u></th><th><u>E-Mail</u></th><th><u>Rolle</u></th></tr>
					@foreach($user as $userItem)
						<tr>
							<td>{{ $userItem->id }}</th>
							<td>{{ $userItem->name }}</th>
							<td><a href="mailto:{{ $userItem->email }}">{{ $userItem->email }}</a></th>
							<td>{{ $userItem->role }}</th>
						</tr>
					@endforeach
				</table>
			</h4>
		@else
			<h1 class="p-5"><u>Die Benutzerliste dürfen nur Admins abrufen!</u></h1>
		@endif
	</div>
</div>

@endsection