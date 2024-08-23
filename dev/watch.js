const { exec } = require( 'child_process' );
const chokidar = require( 'chokidar' );
const fs = require( 'fs' );
const path = require( 'path' );

// Initialize file watcher to monitor changes in PHP files
const watcher = chokidar.watch( '../../wpmvc/**/*.php', {
	persistent: true,
} );

/**
 * Executes PHP-Scoper command and moves the processed file.
 * @param {string} filePath - The path of the changed PHP file.
 */
function runComposer( filePath ) {
	// Command to run PHP-Scoper with the provided file path
	const phpScoperCommand = `php vendor-src/bin/php-scoper add-prefix ${ filePath } --config=dev/scoper.watch.inc.php --output-dir=self-vendor --force`;

	// Execute the PHP-Scoper command
	exec( phpScoperCommand, ( error, stdout, stderr ) => {
		if ( error ) {
			console.error( `Error executing PHP-Scoper: ${ error.message }` );
			return;
		}

		// Output stderr for debugging
		console.log( stderr );

		const selfVendorDir = path.join( __dirname, '..', 'self-vendor' );
		const sourcePath = path.join(
			selfVendorDir,
			path.basename( filePath )
		);
		const destinationPath = path.join(
			__dirname,
			'..',
			'vendor',
			'vendor-src',
			filePath.replaceAll( '../', '' )
		);

		// Move the file from the source to the destination
		fs.rename( sourcePath, destinationPath, ( error ) => {
			if ( error ) {
				console.error(
					`Error: Failed to move ${ sourcePath } to ${ destinationPath }.`,
					error.message
				);
				return;
			}

			// Remove the self-vendor directory if empty
			fs.rmdir( selfVendorDir, ( err ) => {
				if ( err ) {
					console.error(
						`Error: Failed to remove directory ${ selfVendorDir }.`,
						err.message
					);
				}
			} );
		} );
	} );
}

// Event listener for changes in PHP files
watcher.on( 'change', ( filePath ) => {
	console.error( `File ${ filePath } has been changed` );
	runComposer( filePath );
} );

console.log( 'Watching for PHP file changes...' );
