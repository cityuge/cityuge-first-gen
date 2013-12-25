module.exports = function(grunt) {

	// All configuration goes here 
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
		imagemin: {
			png: {
				options: {
					optimizationLevel: 7,
					pngquant: true
				},
				files: [{
					expand: true,
					cwd: 'public/img/',
					src: ['**/*.png'],
					dest: 'public/img/',
					ext: '.png'
				}]
			},
			// jpg: {
			// 	options: {
			// 		progressive: true
			// 	},
			// 	files: [{
			// 		expand: true,
			// 		cwd: 'public/img/',
			// 		src: ['**/*.jpg'],
			// 		dest: 'public/img2/',
			// 		ext: '.jpg'
			// 	}]
			// }
		},
		less: {
			development: {
				options: {
					paths: ['less'],
					compress: true,
					strictMath: false,
					strictUnits: false,
					sourceMap: true,
					sourceMapRootpath: '../..'
				},
				files: {
					'public/css/default.css': 'less/default.less',
					'public/css/error.css': 'less/error.less',
					'public/css/login.css': 'less/login.less'
				}
			},
			production: {
				options: {
					paths: ['less'],
					cleancss: true,
					strictMath: false,
					strictUnits: false,
					report: 'min'
				},
				files: {
					'public/css/default.css': 'less/default.less',
					'public/css/error.css': 'less/error.less',
					'public/css/login.css': 'less/login.less'
				}
			}
		},
		watch: {
			options: {
				livereload: true,
			},
			images: {
				files: ['public/img/**/*.{png,jpg,gif}'],
				tasks: ['imagemin'],
				options: {
					spawn: false,
				},
			},
			// scripts: {
			// 	files: ['public/js-org/*.js'],
			// 	tasks: ['jshint'],
			// 	options: {
			// 		spawn: false,
			// 	},
			// },
			styles: {
				files: ['less/**/*.less'],
				tasks: ['less:development'],
				options: {
					spawn: true,
				},
			}
		}

	});

	// Where we tell Grunt we plan to use this plug-in.
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Where we tell Grunt what to do when we type "grunt" into the terminal.
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('prod', ['imagemin', 'less:production']);

};
