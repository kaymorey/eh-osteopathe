var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cleancss = require('gulp-clean-css'),
    eslint = require('gulp-eslint'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    del = require('del'),
    webserver = require('gulp-webserver');

// Stylesheets
gulp.task('styles', function () {
    return sass('src/Resources/stylesheets/*.scss')
        .pipe(autoprefixer()) // add parameters like 2 last versions ?
        .pipe(cleancss())
        .pipe(gulp.dest('web/stylesheets'));
});

// Scripts
gulp.task('scripts', function () {
    return gulp.src('src/Resources/scripts/*.js')
        .pipe(gulp.dest('web/scripts'));
});

// Images
gulp.task('images', function () {
    return gulp.src('src/Resources/images/**/*')
        .pipe(imagemin()) // add parameters
        .pipe(gulp.dest('web/images'));
});

// Fonts
gulp.task('fonts', function () {
    return gulp.src('src/Resources/fonts/**/*')
        .pipe(gulp.dest('web/fonts'));
});

// Clean
gulp.task('clean', function () {
    return del(['web/stylesheets', 'web/scripts', 'web/images'], {
        force: true
    });
});

// Watch
gulp.task('watch', function () {
    // Watch .scss files
    gulp.watch('src/Resources/stylesheets/**/*.scss', ['styles']).on('change', function (event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

    // Watch .js files
    gulp.watch('src/Resources/scripts/*.js', ['scripts']).on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

    // Watch images files
    gulp.watch('src/Resources/images/**/*', ['images']).on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

    // Watch fonts files
    gulp.watch('src/Resources/fonts/**/*', ['fonts']).on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });
});

// Default task
gulp.task('default', ['clean', 'styles', 'scripts', 'images', 'fonts']);

// Webserver task
gulp.task('webserver', ['default', 'watch'], function () {
    gulp.src('web')
        .pipe(webserver({
            livereload: true,
            open: true
        }));
})

