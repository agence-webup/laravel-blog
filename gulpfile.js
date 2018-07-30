const gulp = require('gulp');
const babel = require('gulp-babel');
const sass = require('gulp-sass');

 
gulp.task( 'sass', function () {
    return gulp.src('./src/resources/assets/sass/*.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest('../../public/vendor/laravel-blog/css'));
});

gulp.task('watch', function () {
  gulp.watch('./src/resources/assets/sass/**/*', gulp.series('sass'));
});
