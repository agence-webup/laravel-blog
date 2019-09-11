const gulp = require('gulp');
const babel = require('gulp-babel');
const sass = require('gulp-sass');
const gnf = require('gulp-npm-files');
const autoprefixer = require('gulp-autoprefixer');

let basePath = '../../../public/vendor/laravel-blog/'

gulp.task('sass', function () {
    return gulp.src('./src/resources/assets/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(gulp.dest(basePath+'css'));
});

gulp.task('js', () =>
    gulp.src('./src/resources/assets/js/**/*.js')
    .pipe(babel({
        presets: ['env']
    }))
    .pipe(gulp.dest(basePath+'js'))
);

gulp.task('copy-npm', () => {
    return gulp.src(gnf(), {
        base: './'
    }).pipe(gulp.dest(basePath));
});


gulp.task('watch', function () {
    gulp.watch('./src/resources/assets/sass/**/*', gulp.series('sass'));
    gulp.watch('./src/resources/assets/js/**/*', gulp.series('js'));
});

gulp.task('default', gulp.parallel('sass', 'js', 'copy-npm'));
