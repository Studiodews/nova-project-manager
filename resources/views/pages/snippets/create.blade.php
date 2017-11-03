@php
	$title = 'New Snippet';

	$defaultData = json_encode([
		'navTopTitle' => old('name'),
		'navTopSubtitle' => old('slug'),
	]);
@endphp

@extends('pages.snippets.main')

@section('nav-top-title')
	<transition appear>
		<strong v-if="navTopTitle">@{{ navTopTitle }}</strong>
		<strong v-else>{{ $title }}</strong>
	</transition>
@endsection

@section('nav-top-actions')
	<a href="/snippets" class="button">Cancel</a>
	<button form="form-create" class="button -green -submit">Create</a>
@endsection

@section('content')
	<div class="single-edit full">
		@if ( $errors->any() )
			<div class="alert -error">
				<ul>
					@foreach ( $errors->all() as $error )
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="POST" id="form-create" name="form-create" action="/snippets">
			<div class="fieldgroup -post-meta">
				<div class="fieldset">
					<label for="name">Name</label>
					<input type="text" id="name" name="name" v-model="navTopTitle" v-send-value send-value-class="project-slug" value="{{ old('name') }}">
				</div>

				<div class="fieldset">
					<label for="slug">Slug</label>
					<div class="inputgroup">
						<span class="prefix">{{ url( '/snippets' ) }}/</span>
						<input type="text" id="slug" name="slug" class="filter-slug" value="{{ old('slug') }}">
					</div>
				</div>

				<div class="fieldset">
					<label for="category">Category</label>
					<input type="text" id="category" name="category" value="{{ old('category') }}" list="categories">
					<datalist id="categories">
						@foreach ( get_categories( 'snippet' ) as $category )
							<option>{{ $category->name }}</option>
						@endforeach
					</datalist>
				</div>
			</div>

			<div class="fieldgroup -post-content">
				<div class="fieldset">
					<label for="body">Content</label>
					<textarea id="body" name="body" rows="12" class="editable">{{ old('body') }}</textarea>
				</div>
			</div>

			{{ csrf_field() }}

			<button class="button -green -submit">Create</button>
		</form>
	</div>
@endsection