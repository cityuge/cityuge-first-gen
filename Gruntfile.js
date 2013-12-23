module.exports = function(grunt) {

	// 1. All configuration goes here 
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		// concat: {
		// 	dist: {
		// 		src: [
		// 			'public/js-org/*.js'
		// 		],
		// 		dest: 'public/js/test.js'
		// 	}
		// },
		// uglify: {
		// 	build: {
		// 		src: 'public/js/test.js',
		// 		dest: 'public/js/test.min.js'
		// 	}
		// },
		// imagemin: {
		// 	dynamic: {
		// 		files: [{
		// 			expand: true,
		// 			cwd: 'public/img',
		// 			src: ['**/*.{png,jpg,gif}'],
		// 			dest: 'public/img2'
		// 		}]
		// 	}
		// },
		less: {
			development: {
				options: {
					paths: ['public/less'],
					compress: true,
					strictMath: false,
					strictUnits: false,
					report: 'min',
					sourceMap: true,
					//sourceMapFilename: 'main.css.map',
					sourceMapRootpath: '../..'
				},
				files: {
					'public/css/default.css': 'public/less/default.less',
					'public/css/error.css': 'public/less/error.less'
				}
			},
			production: {
				options: {
					paths: ['public/less'],
					cleancss: true,
					strictMath: false,
					strictUnits: false,
					report: 'min'
				},
				files: {
					'public/css/default.css': 'public/less/default.less',
					'public/css/error.css': 'public/less/error.less'
				}
			}
		},
		watch: {
			options: {
				livereload: true,
			},
			// scripts: {
			// 	files: ['public/js-org/*.js'],
			// 	tasks: ['jshint'],
			// 	options: {
			// 		spawn: false,
			// 	},
			// },
			styles: {
				files: ['public/less/**/*.less'],
				tasks: ['less:development'],
				options: {
					spawn: true,
				},
			}
		}

	});

	// 3. Where we tell Grunt we plan to use this plug-in.
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	//grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('dist', ['less:production']);

};
