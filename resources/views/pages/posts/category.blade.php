
@extends('pages.posts.main')

@section('nav-top-title')
	{{ $title }}
@endsection

@section('nav-top-actions')
	<a href="{{ url( $url['create'] ) }}" class="button -green">{{ sprintf( __( 'New %s' ), $strings['singular'] ) }}</a>
@endsection

@section('content')
	@if ( count( $posts ) )
		<div class="content-list -grid -posts" data-cols="3">
			@foreach ( $posts as $post )
				<div class="item">
					<a href="{{ url( "{$url['index']}/{$post['slug']}" ) }}">
						<strong class="title">{{ $post['name'] }}</strong>
					</a>
				</div>
			@endforeach
		</div>

		{{ $posts->links() }}
	@else
		<div class="no-content">
			<p>{{ sprintf( __( 'No %1$s in the %2$s folder.' ), $strings['plural'], get_category_name( $category->id ) ) }}</p>
		</div>
	@endif
@endsection
