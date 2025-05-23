module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['bower_components/foundation/scss']
      },
      dist: {
        options: {
          outputStyle: 'compressed',
          sourceMap: true,
        },
        files: {
          'style.css': 'scss/app.scss'
        }
      }
    },
    autoprefixer: {
      dev: {
        options: {
          browsers: ['last 2 version', 'ie 9']
        },
        files: {
          'style.css': 'style.css'
        }
      }
    },
    copy: {
      main: {
        src: [
          'bower_components/jquery/dist/jquery.js',
          'bower_components/foundation/js/foundation/foundation.js',
          'bower_components/foundation/js/foundation/foundation.topbar.js',
          'bower_components/foundation/js/foundation/foundation.offcanvas.js',
          'bower_components/foundation/js/foundation/foundation.equalizer.js',
          'bower_components/foundation/js/foundation/foundation.orbit.js',
          'bower_components/foundation/js/foundation/foundation.accordion.js',
          'bower_components/foundation/js/foundation/foundation.clearing.js'
        ],
        expand: true,
        flatten: true,
        dest: 'js'
      },
    },
    concat: {
      dev: {
        src: [
          'js/jquery.js',
          'js/foundation.js',
          'js/foundation.topbar.js',
          'js/foundation.offcanvas.js',
          'js/foundation.equalizer.js',
          'js/foundation.orbit.js',
          'js/foundation.accordion.js',
          'js/foundation.clearing.js',
          'js/app.js'
        ],
        dest: 'js/build/tbxl.js'
      }
    },
    uglify: {
      dist: {
        files: {
          'js/build/tbxl.min.js': ['js/build/tbxl.js']
        }
      }
    },
    svgstore: {
      options: {
        prefix : 'icon-', // This will prefix each ID
        includedemo: true,
        svg: { // will be added as attributes to the resulting SVG
          class : 'hide svg-icons'
        }
      },
      default : {
        files: {
          'img/icons.svg': ['svgs/*.svg'],
        },
      }
    },
    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass', 'autoprefixer:dev']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-svgstore');

  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['copy', 'concat', 'uglify', 'build','watch']);
}
