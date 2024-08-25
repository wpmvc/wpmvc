const FileManagerPlugin = require( 'filemanager-webpack-plugin' );
const normalizePath = require( 'normalize-path' );
const path = require( 'path' );

const {
	buildFiles,
	buildIgnoreFiles,
	getPluginInfo,
	pluginRootFile,
} = require( './utils' );

const rootDir = path.dirname( __dirname );
const dist = normalizePath( path.join( rootDir, '__build' ) );

module.exports = async () => {
	const version = ( await getPluginInfo() )?.version;
	const zipName = version
		? `${ pluginRootFile }-${ version }`
		: pluginRootFile;

	return {
		entry: {},
		mode: 'production',
		plugins: [
			new FileManagerPlugin( {
				events: {
					onEnd: [
						{ delete: [ dist ] },
						{ copy: buildFiles },
						{ delete: buildIgnoreFiles },
						{
							archive: [
								{
									source: `${ dist }/zip`,
									destination: `${ dist }/${ zipName }.zip`,
									options: {
										zlib: { level: 9 }, // Use maximum compression level
									},
								},
							],
						},
						{
							move: [
								{
									source: `${ dist }/zip/${ pluginRootFile }`,
									destination: `${ dist }/${ pluginRootFile }`,
								},
							],
						},
						{
							delete: [
								path.join( rootDir, 'dist' ),
								`${ dist }/zip`,
							],
						},
					],
				},
			} ),
		],
	};
};
