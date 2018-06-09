module.exports = function(grunt) {

    var sassFiles = [{
        expand: true,
        cwd: 'assets/css/',
        dest: 'assets/css/',
        src: 'assets/css/*.scss',
        ext: '.css'
    }]

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            dist: {
                options: {
                    style: 'expanded',
                },
                files: sassFiles
            }
        },
        watch: {
            css: {
                files: 'assets/css/*.scss',
                tasks: ['sass']
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default',['watch']);
}