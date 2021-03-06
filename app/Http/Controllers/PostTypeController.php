<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Resources\PostCollection;
use App\Category;
use App\PostType;

use Illuminate\Support\Facades\Route;

class PostTypeController extends PostController {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$route     = Route::current();
		$route_url = $route ? $route->uri : 'posts';
		$type      = str_singular( explode( '/', $route_url )[0] );
		$post_type = PostType::where( 'slug', $type )->first();

		$this->url       = $post_type['url'];
		$this->post_type = $post_type;
		$this->strings   = array(
			'singular' => $post_type['name'],
			'plural'   => str_plural( $post_type['name'] )
		);

		\View::share( 'nav_top_head', __( 'Categories' ) );

		\View::share( 'sec_menu_items', get_nav_menu_items( 'categories', array(
			'post_type' => $post_type,
		) ) );

		parent::__construct();
	}

	/**
	 * Display a category folder.
	 *
	 * @param string $category_slug The category slug.
	 * @return \Illuminate\Http\Response
	 */
	public function category_index( string $category_slug ) {
		$category_ids = array();

		$category = Category::where( array(
			array( 'slug', $category_slug ),
			array( 'post_type', $this->post_type->id ),
		) )->first();

		$category_ids[] = $category->id;

		// Display all child categories as well.
		foreach ( $category->descendants() as $child ) {
			$category_ids[] = $child->id;
		}

		$title = sprintf( __( 'Manage %1$s %2$s' ), get_category_name( $category->id ), str_plural( $this->post_type->name ) );

		$posts = new PostCollection( Post::whereIn( 'category', $category_ids )->orderBy( 'created_at', 'desc' )->paginate( 30 ) );

		return view( 'pages.posts.category', compact( 'title', 'category', 'posts' ) );
	}

}
