const FileManagerPlugin = require( 'filemanager-webpack-plugin' );
const normalizePath = require( 'normalize-path' );
const path = require( 'path' );

const { pluginRootFile, buildFiles, buildIgnoreFiles } = require( './utils' );

const rootDir = path.dirname( __dirname );
const dist = normalizePath( path.join( rootDir, '__build' ) );

module.exports = async () => {
	return {
		entry: {},
		mode: 'production',
		plugins: [
			new FileManagerPlugin( {
				events: {
					onEnd: [
						{ delete: [ `${ rootDir }/${ pluginRootFile }` ] },
						{ copy: buildFiles },
						{ delete: buildIgnoreFiles },
						{
							move: [
								{
									source: `${ dist }/zip/${ pluginRootFile }`,
									destination: `${ dist }/../${ pluginRootFile }`,
								},
							],
						},
					],
				},
			} ),
		],
	};
};
