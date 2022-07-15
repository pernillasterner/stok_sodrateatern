var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');


gulp.task('styles', function() {
    gulp.src('assets/styles/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(cleanCSS({compatibility: 'ie9'}))
        .pipe(sourcemaps.write())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('dist/css'));

    gulp.src('assets/styles/admin.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(cleanCSS({compatibility: 'ie9'}))
        .pipe(sourcemaps.write())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('dist/css'));
});

gulp.task('scripts', function() {
    gulp.src(['assets/scripts/plugins/*.js', 'assets/scripts/main.js','assets/scripts/ajax.js'])
      .pipe(concat('main.js'))
      .pipe(rename({suffix: '.min'}))
      .pipe(uglify())
      .pipe(gulp.dest('dist/js'));

    gulp.src(['assets/scripts/jquery.min.js'])
      .pipe(gulp.dest('dist/js'));

    gulp.src(['assets/scripts/jquery-migrate.js'])
      .pipe(rename({suffix: '.min'}))
      .pipe(uglify())
      .pipe(gulp.dest('dist/js'));
});

gulp.task('ajax', function() {
    gulp.src('assets/scripts/ajax.js')
      .pipe(rename({suffix: '.min'}))
      .pipe(uglify())
      .pipe(gulp.dest('dist/js'));
});



gulp.task('fonts', function() {
    return gulp.src(['assets/fonts/*.*'])
      .pipe(gulp.dest('dist/fonts'));
});

gulp.task('images', function () {
    return gulp.src('assets/images/*.*')
      .pipe(gulp.dest('dist/images'))
});

gulp.task('watch', function() {
   // Watch .js files
  gulp.watch('assets/scripts/*.js', ['scripts'])
   // Watch .scss files
  gulp.watch('assets/styles/**/*.scss',['styles']);
 });


gulp.task('default', ['scripts', 'ajax', 'styles', 'fonts', 'images']);
