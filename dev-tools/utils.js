const path = require( 'path' );
const fs = require( 'fs' ).promises;
const normalizePath = require( 'normalize-path' );

const pluginRootFile = 'MyPluginName';
const rootDir = path.dirname( __dirname );
const dist = normalizePath( path.join( rootDir, '__build' ) );

const getPluginInfo = async () => {
	try {
		const fileDir = path.join( rootDir, `${ pluginRootFile }.php` );
		const content = await fs.readFile( fileDir, 'utf8' );

		const versionRegex = /Version:\s+([\w.-]+)/;
		const textDomainRegex = /Text Domain:\s+\s*([\w-]+)/;

		const versionMatch = content.match( versionRegex );
		const textDomainMatch = content.match( textDomainRegex );

		const version = versionMatch ? versionMatch[ 1 ] : '';
		const textDomain = textDomainMatch ? textDomainMatch[ 1 ] : '';

		return { version, textDomain };
	} catch ( error ) {
		console.error( 'Error reading file:', error );
		return {};
	}
};

const transformBuildPaths = ( file_path ) => {
	if ( Array.isArray( file_path ) && file_path.length === 2 ) {
		return {
			source: file_path[ 0 ],
			destination: `${ dist }/zip/${ pluginRootFile }/${ file_path[ 1 ] }`,
		};
	}

	return {
		source: file_path,
		destination: `${ dist }/zip/${ pluginRootFile }/${ file_path }`,
	};
};

const buildFiles = [
	'app',
	'assets',
	'config',
	'database',
	'enqueues',
	'languages',
	'resources/views',
	'routes',
	'vendor',
	'readme.txt',
	`${ pluginRootFile }.php`,
].map( transformBuildPaths );

const buildIgnoreFiles = [
	'**/Gruntfile.js',
	'**/.gitignore',
	'**/.DS_Store',
	'vendor/vendor-src/bin',
	'vendor/scoper-autoload.php',
	'**/dev/**',
	'**/dev-*/**',
	'**/*-test/**',
	'**/*-beta/**',
	'**/scss/**',
	'**/sass/**',
	'**/.*',
	'**/build/*.txt',
	'**/*.map',
	'**/assets/build/**/*-rtl.css',
	'**/*.config',
	'**/*.config.js',
	'**/package.json',
	'**/package-lock.json',
	'**/tsconfig.json',
	'**/mix-manifest.json',
	'**/phpcs.xml',
	'**/composer.json',
	'**/composer.lock',
	'**/*.md',
	'**/*.mix.js',
	'**/none',
	'**/artisan',
	'**/phpcs-report.xml',
	'**/LICENSE',
	'**/Installable',
	'**/tests',
	'**/composer/installed.json',
	'**/install-wp-tests.sh', //This file is coming form wp background processor package.
	'**/*.exe',
	'**/*.bash',
].map( ( file_path ) => `${ dist }/zip/${ pluginRootFile }/${ file_path }` );

module.exports = {
	pluginRootFile,
	getPluginInfo,
	buildFiles,
	buildIgnoreFiles,
};
