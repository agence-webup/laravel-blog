const gulp = require('gulp')
const Gulpy = require('@agence-webup/gulpy')

// config
const gulpy = new Gulpy({
  publicFolder: 'public/assets/'
})

// front
const sass = gulpy.sass('src/resources/assets/sass/laravel-blog.scss', 'public/assets/css')
const js = gulpy.js(['src/resources/assets/js/**/*', '!src/resources/assets/js/*.js'], 'public/assets/js')
const bundle = gulpy.bundle('src/resources/assets/js/*.js', 'public/assets/js', 'bundle.js')
const clean = gulpy.clean(['public/assets/**'])
const copyNpm = gulpy.copyNpm('public/node_modules')

// export
exports.default = gulp.series(clean, gulp.parallel(sass, js, bundle, copyNpm))

exports.watch = gulpy.watch()
