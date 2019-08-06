@extends('layouts.app')

@section('content')

<div class="text-center">

	@if (Session::has('errorCreateKey'))
		<div class="alert alert-danger">{{Session::get('errorCreateKey')}}</div>
	@endif

	@if (Session::has('successCreateKey'))
		<div class="alert alert-success">{{Session::get('successCreateKey')}}</div>
	@endif

	@if (Session::has('errorDeleteKey'))
		<div class="alert alert-danger">{{Session::get('errorDeleteKey')}}</div>
	@endif

	@if (Session::has('successDeleteKey'))
		<div class="alert alert-success">{{Session::get('successDeleteKey')}}</div>
	@endif

	@if (Session::has('errorDeleteKeyInShelf'))
		<div class="alert alert-warning">{{Session::get('errorDeleteKeyInShelf')}}</div>
	@endif

	@if (Session::has('successRenameKey'))
		<div class="alert alert-success">{{Session::get('successRenameKey')}}</div>
	@endif

	@if (Session::has('errorRenameKey'))
		<div class="alert alert-danger">{{Session::get('errorRenameKey')}}</div>
	@endif

	@if(Auth::check())
	@else
		<?php return redirect('register')->with(['errorDeleteKeyInShelf'=>'Schlüssel konnte nicht gelöscht werden, da er in einem Regalplatz liegt.']);
		?>
	@endif
	<h1>Willkommen in der Schlüsselverwaltung!</h1>
	<hr style="border: 1px solid lightgrey;border-style: dashed;color: grey">
	<div class="border border-dark shadow p-3 mb-3 bg-white" style="border-radius: 50px;margin: 0px 150px 0px 150px">
	    	<u><b>Alle Schlüssel:</b></u>
	    	<?php $user = new \App\User(); ?>
				@foreach ($key as $keyItem)
					<?php $shelfs = $keyItem->shelf; ?>
					@if($shelfs)
						<li>
							<u>
								Der Schlüssel {{ $keyItem->name }} liegt im Regalplatz {{ $keyItem->shelf->nummer }}
							</u>
							@if(Auth::check() && $user->where('name',Auth::user()->name)->value('role') == 'admin')
								<input type="checkbox" class="m-1" name="selectedRows[]" value="<?php echo $keyItem->id ?>">
							@else
								<input type="checkbox" class="disabled m-1" name="selectedRows[]" value="<?php echo $keyItem->id ?>">
							@endif
						</li>
					@endif
					@if(!$shelfs)
						<li>Der Schlüssel {{ $keyItem->name }} wurde noch nicht aufgehangen!</li>
					@endif
				@endforeach
	    </div>

	<b><u><p><br>Schlüssel eintragen:</p></u></b>

		<form method="POST" action="/storeKey">
			{{ csrf_field() }}
			<div>
				<input class="btn border-dark text-left" type="text" name="keyname" required="true" placeholder="Name">
				<input class="btn border-dark text-left" type="text" name="keyDescription" placeholder="Beschreibung (optional)">
				<button class="btn btn-primary border-dark text-left" type="submit">Schlüssel eintragen</button>
			</div>
			<br>
		</form>

	<b><u><p><br>Schlüssel löschen:</p></u></b>

	<form method="POST" action="/deleteKey">
		{{ csrf_field() }}
		<div>
			<input class="btn border-dark text-left" type="text" name="keyname" required="true" placeholder="Name">
			<button class="btn btn-primary border-dark text-left" type="submit">Schlüssel löschen</button>
		</div>
		<br>
	</form>

	<b><u><p><br>Schlüssel umbenennen:</p></u></b>

	<form method="POST" action="/renameKey">
		{{ csrf_field() }}
		<div>
			<input class="btn border-dark text-left" type="text" name="keyname" required="true" placeholder="Name">
			<input class="btn border-dark text-left" type="text" name="newKeyname" required="true" placeholder="Neuer Name">
			<input class="btn border-dark text-left" type="text" name="newDesc" placeholder="Neue Beschr. (optional)">
			<button class="btn btn-primary border-dark text-left" type="submit">Schlüssel umbenennen</button>
		</div>
		<br>
	</form>
</div>
@endsection