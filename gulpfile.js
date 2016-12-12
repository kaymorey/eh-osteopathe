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

// Fonts
gulp.task('fonts', function () {
    return gulp.src('src/fonts/**/*')
        .pipe(gulp.dest('dist/fonts'));
});

// Template files
gulp.task('templates', function () {
    return gulp.src('src/content/pages/**/*.+(html|nunjucks)')
        .pipe(nunjucksrender({
            path: ['src/content/templates']
        }))
        .pipe(gulp.dest('dist/'));
});

// Move admin files
gulp.task('admin', function () {
    return gulp.src(['admin/**/*'], {dot: true})
        .pipe(gulp.dest('dist/admin/'))
})

// Clean
gulp.task('clean', function () {
    return del(['dist/stylesheets', 'dist/scripts', 'dist/images', 'dist/admin'], {
        force: true
    });
});

// Watch
gulp.task('watch', function () {
    // Watch .scss files
    gulp.watch('src/stylesheets/**/*.scss', ['styles']).on('change', function (event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

    // Watch .js files
    gulp.watch('src/scripts/*.js', ['scripts']).on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

    // Watch images files
    gulp.watch('src/images/**/*', ['images']).on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

    // Watch fonts files
    gulp.watch('src/fonts/**/*', ['fonts']).on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });

    // Watch template files
    gulp.watch('src/content/**/*.+(html|nunjucks)', ['templates']).on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });
});

// Default task
gulp.task('default', ['clean', 'styles', 'scripts', 'images', 'fonts', 'templates', 'admin']);

// Webserver task
gulp.task('webserver', ['default', 'watch'], function () {
    gulp.src('dist')
        .pipe(webserver({
            livereload: true,
            open: true
        }));
})

