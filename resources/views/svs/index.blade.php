@extends('layouts.app')
@section('content')
    <div class="text-center">
		<h1 class="text-center">
			Willkommen im Schlüsselverwaltungssystem<br>
			<u>Neue Aufgaben:</u><br>
			
			<h4><li>Mehrere Rollen, jede Rolle darf nur bestimmte Schlüssel benutzen</li>
			<li>Schlüssel Histore: Wer hat welchen Schlüssel wann benutzt?</li></h4>
    	</h1>

	    <br>
	    
    	<b><u><p>Schlüssel aufhängen:</p></u></b>

		<form method="POST" action="/storeKeyIntoShelf">
			{{ csrf_field() }}
			<div>
				<input class="btn border-dark text-left" type="text" placeholder="Regalplatznummer" name="rpnr" required="true">
				<input class="btn border-dark text-left" type="text" placeholder="Schlüsselname" name="keyname" required="true">
				<button class="btn btn-primary border-dark text-left" type="submit" name="aufhaengen">Schlüssel aufhängen</button>
			</div>
			<br>
		</form>

		<b><u><p>Schlüssel abhängen:</p></u></b>

		<form method="POST" action="/takeKeyOutOfShelf">
			{{ csrf_field() }}
			<div>
				<input class="btn border-dark text-left" type="text" placeholder="Schlüsselname" name="keyname" required="true">
				<button class="btn btn-primary border-dark text-left" type="submit" name="abhaengen">Schlüssel abhängen
				</button>
			</div>
			<br>
		</form>

		
		<div class="border border-dark shadow p-3 mb-3 bg-white" style="border-radius: 50px;margin: 0px 150px 0px 150px">
			<u><b>Alle Regalplätze:</b></u>
			<?php $user = new \App\User(); ?>
			@foreach($shelf as $shelfItem)
			<?php $keys = $shelfItem->key; ?>
				@if($keys)
					<li>
						<u>
							Der Regalplatz {{ $shelfItem->nummer }} beinhaltet den Schlüssel {{ $shelfItem->key->name }}
						</u>
						@if(Auth::check() && $user->where('name',Auth::user()->name)->value('role') == 'admin')
							<form method="POST" class="d-inline">
								<input type="checkbox" class="m-1" name="selectedRows[]" value="<?php echo $shelfItem->id ?>">
							</form>
						@else
							<form method="POST" class="d-inline">
								<input type="checkbox" class="disabled m-1" name="selectedRowsRP[]" value="<?php echo $shelfItem->id ?>">
							</form>
						@endif
					</li>
				@endif
				@if(!$keys)
					<li>Der Regalplatz {{ $shelfItem->nummer }} ist leer</li>
				@endif
			@endforeach
	    </div>
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
								<form method="POST" class="d-inline">
									<input type="checkbox" class="m-1" name="selectedRowsKey[]" value="<?php echo $shelfItem->id ?>">
								</form>
							@else
								<form method="POST" class="d-inline">
									<input type="checkbox" class="disabled m-1" name="selectedRows[]" value="<?php echo $shelfItem->id ?>">
								</form>
							@endif
						</li>
					@endif
					@if(!$shelfs)
						<li>Der Schlüssel {{ $keyItem->name }} wurde noch nicht aufgehangen!</li>
					@endif
				@endforeach
	    </div>
    </div>
@endsection