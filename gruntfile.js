module.exports = function(grunt) {
  grunt.initConfig({
  	pkg: grunt.file.readJSON('package.json'),

    concat: {
	    
	    concatcss:{
	    	src: [
            'assets/css/head.css',
            '.cache/master.min.css' 
        ],
        dest: 'style.css'
	    }
    },
		
		sass: {
	    dist: {
	      options: {
	      	style: 'nested'
	      },
	      files: {
	      	'.cache/master.scss.css': 'master.scss'
	      }
	    } 
		},
		
		autoprefixer: {
	    single_file: {
	      options: {
	        // Target-specific options go here.
	      },
	      src: '.cache/master.scss.css',
	      dest: '.cache/master.css'
	    },
	  },
	  
	  min: {
	  	dist: {
	    	src: ['js/plugins/*.js',
	    	'js/scripts.js'
	    	],
        dest: 'js/bundled.min.js'
	    }
		},
			
		cssmin: {
	    dist: {
	    	src: ['.cache/master.css'],
	    	dest: '.cache/master.min.css'
	    }
		},
			  
	  watch: {
			options: {
      	livereload: true,
    	},
    
	    scripts: {
	      files: ['js/**/*.js'],
	      tasks: ['min'],
	      options: {
	        spawn: false
	      },
	    },
		    
		 	css: {
				files: ['**/*.scss'],
			  tasks: ['sass','autoprefixer', 'cssmin', 'concat'],
			  options: {
			    spawn: false
			  }
			}
		}

  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-yui-compressor');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
  grunt.registerTask('default', ['sass', 'autoprefixer', 'cssmin', 'concat', 'min', 'watch']);
};