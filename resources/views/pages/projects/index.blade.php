@php
	$title = 'Manage projects';

	$projects = App\Project::all();
@endphp

@extends('pages.projects.main')

@section('nav-top-title')
	{{ $title }}
@endsection

@section('nav-top-actions')
	<a href="{{ url( 'projects/create' ) }}" class="button -green">Create Project</a>
@endsection

@section('content')
	@if ( count( $projects ) )
		<div class="content-grid">
			@foreach ( $projects as $project )
				<div class="grid-item">
					<a href="{{ url( 'projects/' . $project['slug'] ) }}">
						<strong class="title">{{ $project['name'] }}</strong>
						<small class="subtitle">{{ get_category( $project->category_id ) }}</small>
					</a>
				</div>
			@endforeach
		</div>
	@else
		<div class="no-content">
			<p>No projects created.</p>
			<a href="{{ url( 'projects/create' ) }}" class="button -green">Create a Project</a>
		</div>
	@endif
@endsection