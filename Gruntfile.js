/*jshint es3:false */
module.exports = function(grunt) {

	// All configuration goes here 
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		jshint: {
			files: ['Gruntfile.js', 'js/**/*.js'],
			options: {
				// http://www.jshint.com/docs/options/
				ignores: ['js/vendor/**/*.js'],
				smarttabs: true,
				trailing: true,
				noempty: true,
				es3: true,
				unused: true,
				undef: 'vars',
				eqnull: true,
				browser: true,
				devel: true,
				globals: {
					jquery: true,
					module: false,
					require: false,
					define: false,
				}
			}
		},
		clean: [
			'public/js/vendor',
			'public/js/build.txt'
		],
		concat: {
			development: {
				files: {
					'public/js/default.js': ['public/js/config.js', 'public/js/default.js'],
					'public/js/comments-all.js': ['public/js/config.js', 'public/js/comments-all.js']
				}
			}
		},
		uglify: {
			options: {
				// Put a banner on each uglified file
				banner: '/*! <%= pkg.description %> - <%= grunt.template.today("ddd, mmm d, yyyy, h:MM:ss Z") %> */\n'
			},
			build: {
				files: [{
					expand: true,
					cwd: 'public/js',
					src: '**/*.js',
					dest: 'public/js'
				}]
			}
		},
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
				livereload: true
			},
			images: {
				files: ['public/img/**/*.{png,jpg,gif}'],
				tasks: ['imagemin'],
				options: {
					spawn: false
				}
			},
			styles: {
				files: ['less/**/*.less'],
				tasks: ['less:development'],
				options: {
					spawn: true
				}
			}
		}

	});

	// Where we tell Grunt we plan to use this plug-in.
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Where we tell Grunt what to do when we type "grunt" into the terminal.
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('prod', ['clean', 'uglify', 'imagemin', 'less:production']);
	grunt.registerTask('test', ['jshint', 'concat']);

};
