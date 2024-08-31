const Utils = require( './utils' );

module.exports = ( grunt ) => {
	'use strict';

	const projectConfig = {
		srcDir: '../',
	};

	const textDomainFiles = [
		'*.php',
		'**/*.php',
		'!CustomSniffs/**',
		'!dev-tools/**',
		'!node_modules/**',
		'!vendor/**',
		'!vendor-src/**',
		'!__build/**',
	];

	grunt.initConfig( {
		clean: {
			options: { force: true },
			dist: [ '../languages/**/*.pot', '../__build/**' ],
		},
		addtextdomain: {
			options: {
				updateDomains: true, // List of text domains to replace.
			},
			target: {
				files: {
					src: textDomainFiles,
				},
			},
		},

		checktextdomain: {
			standard: {
				options: {
					text_domain:
						'<%= grunt.config.get("screen.begin.options.data.textDomain") %>', //Specify allowed domain(s)
					// correct_domain: true, // don't use it, it has bugs
					keywords: [
						//List keyword specifications
						'__:1,2d',
						'_e:1,2d',
						'_x:1,2c,3d',
						'esc_html__:1,2d',
						'esc_html_e:1,2d',
						'esc_html_x:1,2c,3d',
						'esc_attr__:1,2d',
						'esc_attr_e:1,2d',
						'esc_attr_x:1,2c,3d',
						'_ex:1,2c,3d',
						'_n:1,2,4d',
						'_nx:1,2,4c,5d',
						'_n_noop:1,2,3d',
						'_nx_noop:1,2,3c,4d',
					],
				},
				files: [
					{
						src: textDomainFiles,
						expand: true,
					},
				],
			},
		},

		makepot: {
			target: {
				options: {
					cwd: projectConfig.srcDir, // Directory of files to internationalize.
					mainFile: '', // Main project file.
					type: 'wp-plugin', // Type of project (wp-plugin or wp-theme).
					updateTimestamp: false, // Whether the POT-Creation-Date should be updated without other changes.
					updatePoFiles: false, // Whether to update PO files in the same directory as the POT file.
				},
			},
		},

		/**
		 * -------------------------------------
		 * @description print ASCII text
		 * @see https://fsymbols.com/generators/carty/
		 * -------------------------------------
		 */

		screen: {
			begin: {
				options: {
					data: {
						version: '1.0.0',
						textDomain: 'myplugin',
					},
				},
				template: `
		# Project   : ${ Utils.pluginRootFile }
		# Dist      : ./__build/${ Utils.pluginRootFile }/
		# Version   : <%= grunt.config.get("screen.begin.options.data.version") %>`
					.cyan,
			},
			textdomainchecking: {
				template:
					`Checking textdomain [<%= grunt.config.get("screen.begin.options.data.textDomain") %>]`
						.cyan,
			},
			finish: {
				template: `
		╭─────────────────────────────────────────────────────────────────╮
		│                                                                 │
		│                      All tasks completed.                       │
		│  Built files & Installable zip copied to the __build directory.  │
		│                         ~ WpMVC ~                               │
		│                                                                 │
		╰─────────────────────────────────────────────────────────────────╯
		`.green,
			},
		},
	} );

	/**
	 * ----------------------------------
	 * @description Register grunt tasks
	 * ----------------------------------
	 */
	require( 'load-grunt-tasks' )( grunt );

	grunt.registerTask( 'getPluginInfo', async function () {
		var done = this.async();
		const version = await Utils.getPluginInfo(); // Fetch or determine the plugin version dynamically
		grunt.config.set( 'screen.begin.options.data', version );
		done( true );
	} );

	grunt.registerTask( 'textDomainTasks', [
		'clean',
		'screen:textdomainchecking',
		'addtextdomain',
		'checktextdomain',
		'makepot',
	] );

	grunt.registerTask( 'screen:textdomainchecking', function () {
		const template = grunt.config.get(
			'screen.textdomainchecking.template'
		);
		const rendered = grunt.template.process( template, {} );
		grunt.log.writeln( rendered );
	} );

	grunt.registerTask( 'screen:begin', function () {
		const template = grunt.config.get( 'screen.begin.template' );
		const rendered = grunt.template.process( template, {
			data: grunt.config.get( 'screen.begin.options.data' ),
		} );
		grunt.log.writeln( rendered );
	} );

	grunt.registerTask( 'screen:finish', function () {
		const template = grunt.config.get( 'screen.finish.template' );
		const rendered = grunt.template.process( template, {} );
		grunt.log.writeln( rendered );
	} );

	/**
	 * text domain fixing task
	 */
	grunt.registerTask( 'fixtextdomain', [
		'getPluginInfo',
		'textDomainTasks',
	] );

	/**
	 * Build and compress task
	 */
	grunt.registerTask( 'build', [
		'getPluginInfo',
		'screen:begin',
		'textDomainTasks',
	] );
};
