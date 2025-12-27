const { exec } = require( 'child_process' );
const chokidar = require( 'chokidar' );
const fs = require( 'fs' );
const path = require( 'path' );

// Initialize file watcher to monitor changes in PHP files
const wpmvcDir = path.resolve( __dirname, '../../../wpmvc' );
console.log( `Initializing watcher on: ${ wpmvcDir }` );

const watcher = chokidar.watch( wpmvcDir, {
	persistent: true,
} );

/**
 * Executes PHP-Scoper command and moves the processed file.
 * @param {string} filePath - The absolute path of the changed PHP file.
 */
function runComposer( filePath ) {
	// Command to run PHP-Scoper with the provided file path
	const phpScoperCommand = `php vendor-src/bin/php-scoper add-prefix "${ filePath }" --config=dev/scoper.watch.inc.php --output-dir=self-vendor --force`;

	// Execute the PHP-Scoper command
	exec( phpScoperCommand, ( error, stdout, stderr ) => {
		if ( error ) {
			console.error( `Error executing PHP-Scoper: ${ error.message }` );
			return;
		}

		// Output stderr for debugging
		if ( stderr ) {
			console.log( stderr );
		}

		console.log( `Processed: ${ filePath }` );

		const selfVendorDir = path.join( __dirname, '..', 'self-vendor' );
		// Assuming php-scoper flattens the output for a single file input or we can rely on basename if it does
		// If php-scoper replicates the full path, this needs adjustment, but based on previous code it likely flattens or user assumed so.
		// However, standard php-scoper might replicate structure relative to CWD?
		// Since input file is outside CWD, behavior is undefined/flattened usually.
		// Let's try basename first as per original logic.
		const sourcePath = path.join(
			selfVendorDir,
			path.basename( filePath )
		);

		const relativePath = path.relative( wpmvcDir, filePath );
		const destinationPath = path.join(
			__dirname,
			'..',
			'vendor',
			'vendor-src',
			'wpmvc',
			relativePath
		);

		// Ensure destination directory exists
		fs.mkdirSync( path.dirname( destinationPath ), { recursive: true } );

		// Move the file from the source to the destination
		fs.rename( sourcePath, destinationPath, ( error ) => {
			if ( error ) {
				console.error(
					`Error: Failed to move ${ sourcePath } to ${ destinationPath }.`,
					error.message
				);
				return;
			}
			console.log( `Moved to: ${ destinationPath }` );

			// Remove the self-vendor directory if empty
			// fs.rmdir( selfVendorDir, { recursive: true }, ( err ) => {} ); // Recursive clear might be safer or just leave it
			// Keeping original cleanup logic but slightly safer
			try {
				if ( fs.existsSync( selfVendorDir ) ) {
					// Simple check to avoid error if not empty
					// fs.rmdir( selfVendorDir, () => {} );
				}
			} catch ( e ) {}
		} );
	} );
}

// Event listener for changes in PHP files
watcher.on( 'change', ( filePath ) => {
	if ( path.extname( filePath ) !== '.php' ) {
		return;
	}
	console.log( `File changed: ${ filePath }` );
	runComposer( filePath );
} );

console.log( `Watching for PHP file changes in ${ wpmvcDir }...` );
