<?php

namespace CustomSniffs\Sniffs\Files;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ABSPATHDefinedSniff implements Sniff {
    protected $processed_files = [];

    public function register() {
        return [T_OPEN_TAG];
    }

    public function process( File $phpcs_file, $stack_ptr ) {
        // Check if the file has already been processed
        if ( isset( $this->processed_files[$phpcs_file->getFilename()] ) ) {
            return;
        }

        $this->processed_files[$phpcs_file->getFilename()] = true;

        $tokens  = $phpcs_file->getTokens();
        $content = '';

        for ( $i = $stack_ptr; $i < count( $tokens ); $i++ ) {
            // Skip if phpcs:ignore comment is found
            if ( strpos( $tokens[$i]['content'], 'phpcs:ignore CustomSniffs.Files.ABSPATHDefined.ABSPATHCheck' ) !== false ) {
                return;
            }

            // Skip inline HTML and comments
            if ( $tokens[$i]['code'] === T_INLINE_HTML || $tokens[$i]['code'] === T_COMMENT ) {
                continue;
            }

            // Accumulate content to check for ABSPATH definition
            $content .= $tokens[$i]['content'];

            // Stop accumulating after encountering the first closing PHP tag
            if ( $tokens[$i]['code'] === T_CLOSE_TAG ) {
                break;
            }
        }

        // Check for the presence of ABSPATH definition
        if ( strpos( $content, "defined( 'ABSPATH' )" ) === false && strpos( $content, 'defined( "ABSPATH" )' ) === false ) {
            $phpcs_file->addError( 'Missing "defined( \'ABSPATH\' )" check at the beginning of the file', $stack_ptr, 'ABSPATHCheck' );
        }
    }
}
