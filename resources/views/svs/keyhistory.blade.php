@extends('layouts.app')
@section('content')
	
	<div class="text-center">
		<h1>Willkommen in der Schlüsselhistorie!</h1>
		<hr style="border: 1px solid lightgrey;border-style: dashed;color: grey">
	</div>
	<?php echo $key->select('updated_by')->whereNull('updated_by')->value('updated_by'); ?>

@endsection