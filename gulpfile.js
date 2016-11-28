var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cleancss = require('gulp-clean-css'),
    eslint = require('gulp-eslint'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    nunjucksrender = require('gulp-nunjucks-render'),
    del = require('del'),
    webserver = require('gulp-webserver');

// Stylesheets
gulp.task('styles', function () {
    return sass('src/stylesheets/*.scss')
        .pipe(autoprefixer()) // add parameters like 2 last versions ?
        .pipe(cleancss())
        .pipe(gulp.dest('dist/stylesheets'));
});

// Scripts
gulp.task('scripts', function () {
    return gulp.src('src/scripts/*.js')
        .pipe(eslint())
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist/scripts'));
});

// Images
gulp.task('images', function () {
    return gulp.src('src/images/**/*')
        .pipe(imagemin()) // add parameters
        .pipe(gulp.dest('dist/images'));
});

// Template files
gulp.task('templates', function () {
    return gulp.src('src/content/pages/**/*.+(html|nunjucks)')
        .pipe(nunjucksrender({
            path: ['src/content/templates']
        }))
        .pipe(gulp.dest('dist/'));
})

// Clean
gulp.task('clean', function () {
    return del(['dist/stylesheets', 'dist/scripts', 'dist/images']);
});

// Watch
gulp.task('watch', function () {
    // Watch .scss files
    gulp.watch('src/stylesheets/**/*.scss', function (event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
        gulp.run('styles');
    });

    // Watch .js files
    gulp.watch('src/scripts/*.js', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
        gulp.run('scripts');
    });

    // Watch image files
    gulp.watch('src/images/**/*', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
        gulp.run('images');
    });

    // Watch template files
    gulp.watch('src/content/**/*.+(html|nunjucks)', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
        gulp.run('templates');
    });

});

// Default task
gulp.task('default', ['styles', 'scripts', 'images', 'templates', 'clean']);

// Webserver task
gulp.task('webserver', ['default', 'watch'], function () {
    gulp.src('dist')
        .pipe(webserver({
            livereload: true,
            open: true
        }));
})

