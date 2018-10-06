@extends('mylayouts')
@section('content')


<div class="card">


	<div class="card-header">
		All Activity
		&nbsp;
		<a href="{{ route('activity.chart') }}" class="btn btn-primary btn-sm">Lihat Chart</a>
	</div>


	<div class="card-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Biaya</th>
					<th>Level</th>
					<th>Lingkup</th>
					<th>Kategori</th>
				</tr>
			</thead>

			<tbody>
				@foreach($activities as $key=>$activity)
					<tr>
						<td>{{ $activity->name }}</td>
						<td>{{ $activity->cost }}</td>
						<td>{{ $activity->human_type }}</td>
						<td>{{ $activity->human_scope }}</td>
						<td>{{ $activity->human_category }}</td>
					</tr>
				@endforeach
			</tbody>

		</table>
	</div>


</div>
@endsection