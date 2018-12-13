let mix = require( 'laravel-mix' );

mix.js( 'resources/assets/js/app.js', 'public/js' );

mix.sass( 'resources/assets/sass/app.scss', 'public/css' );

mix.browserSync( {
	proxy: 'npm.nov',
	snippetOptions: {
		whitelist: ["/**"],
	},
	notify: false
} );