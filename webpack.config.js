const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

const devHost = 'wpmvc.local';

module.exports = {
	...defaultConfig,
	entry: {
		'js/app': './resources/js/app.js',
		'css/app': './resources/sass/app.scss',
	},
	output: {
		path: path.resolve( __dirname, './assets/build/' ),
		filename: '[name].js',
		clean: false,
	},
	devServer: {
		devMiddleware: {
			writeToDisk: true,
		},
		allowedHosts: 'auto',
		port: 8887,
		host: devHost,
		proxy: {
			'/assets/build': {
				pathRewrite: {
					'^/assets/build': '',
				},
			},
		},
		headers: { 'Access-Control-Allow-Origin': '*' },
	}
};
