@extends('layouts.app')

@section('content')

<div class="text-center">

	@if (Session::has('errorCreateShelf'))
		<div class="alert alert-danger">{{Session::get('errorCreateShelf')}}</div>
	@endif

	@if (Session::has('successCreateShelf'))
		<div class="alert alert-success">{{Session::get('successCreateShelf')}}</div>
	@endif

	@if (Session::has('errorDeleteShelf'))
		<div class="alert alert-danger">{{Session::get('errorDeleteShelf')}}</div>
	@endif

	@if (Session::has('successDeleteShelf'))
		<div class="alert alert-success">{{Session::get('successDeleteShelf')}}</div>
	@endif

	@if (Session::has('errorDeleteShelfWithKey'))
		<div class="alert alert-warning">{{Session::get('errorDeleteShelfWithKey')}}</div>
	@endif

	@if (Session::has('successRenameShelf'))
		<div class="alert alert-success">{{Session::get('successRenameShelf')}}</div>
	@endif

	@if (Session::has('errorRenameShelf'))
		<div class="alert alert-danger">{{Session::get('errorRenameShelf')}}</div>
	@endif

	<h1>Willkommen in der Regalplatzverwaltung!</h1>
	<hr style="border: 1px solid lightgrey;border-style: dashed;color: grey">
	<div class="border border-dark shadow p-3 mb-3 bg-white" style="border-radius: 50px;margin: 0px 150px 0px 150px">
			<u><b>Alle Regalplätze:</b></u>
			@foreach($shelf as $shelfItem)
			<?php $keys = $shelfItem->key; ?>
				@if($keys)
					<li>
						<u>
							Der Regalplatz {{ $shelfItem->nummer }} beinhaltet den Schlüssel {{ $shelfItem->key->name }}
						</u>
						<input type="checkbox" class="m-1" name="selectedRows[]" value="<?php echo $shelfItem->id ?>">
					</li>
				@endif
				@if(!$keys)
					<li>Der Regalplatz {{ $shelfItem->nummer }} ist leer</li>
				@endif
			@endforeach
	</div>

	<b><u><p><br>Regalplatz eintragen:</p></u></b>

	<form method="POST" action="/storeShelf">
		{{ csrf_field() }}
		<div>
			<input class="btn border-dark text-left" type="text" name="rpnr" placeholder="Nummer"required="true">
			<button class="btn btn-primary border-dark text-left" type="submit">Regalplatz eintragen</button>
		</div>
		<br>
	</form>

	<b><u><p><br>Regalplatz löschen:</p></u></b>

	<form method="POST" action="/deleteShelf">
		{{ csrf_field() }}
		<div>
			<input class="btn border-dark text-left" type="text" name="rpnr" placeholder="Nummer" required="true">
			<button class="btn btn-primary border-dark text-left" type="submit">Regalplatz löschen</button>
		</div>
		<br>
	</form>

	<b><u><p><br>Regalplatz umbenennen:</p></u></b>

	<form method="POST" action="/renameShelf">
		{{ csrf_field() }}
		<div>
			<input class="btn border-dark text-left" type="text" name="rpnr" placeholder="Nummer" required="true">
			<input class="btn border-dark text-left" type="text" name="newrpnr" placeholder="Neue Nummer" required="true">
			<button class="btn btn-primary border-dark text-left" type="submit">Regalplatz umbenennen</button>
		</div>
		<br>
	</form>
</div>

@endsection