'use strict';

// Load plugins
const autoprefixer = require('autoprefixer');
const browsersync = require('browser-sync').create();
const cp = require('child_process');
const cssnano = require('cssnano');
const del = require('del');
const gulp = require('gulp');
// const imagemin = require('gulp-imagemin');
const newer = require('gulp-newer');
const plumber = require('gulp-plumber');
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const sass = require('gulp-sass')(require('sass'));
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');

// BrowserSync
function browserSync(done) {
  browsersync.init({
    open: false,
    proxy: 'http://klyp.jerry.php/', // replace it with yours
    port: 3000
  });
  done();
}

// html
function html()
{
  return gulp
  .src([
    './*.html',
  ])
  .pipe(browsersync.stream());
}

// clean
function clean() {
  return del(['./assets/dist/']);
}

// imges
// function images() {
//   return gulp
//     .src('./assets/src/img/**/*')
//     .pipe(newer('./assets/dist/img'))
//     .pipe(
//       imagemin([
//         imagemin.gifsicle({ interlaced: true }),
//         imagemin.jpegtran({ progressive: true }),
//         imagemin.optipng({ optimizationLevel: 5 }),
//         imagemin.svgo({
//           plugins: [
//             {
//               removeViewBox: false,
//               collapseGroups: true
//             }
//           ]
//         })
//       ])
//     )
//     .pipe(gulp.dest('./assets/dist/img'));
// }

// css
function css() {
  return gulp
    .src('./assets/src/scss/**/*.scss')
    .pipe(plumber())
    .pipe(sass({ outputStyle: 'expanded' }))
    .pipe(gulp.dest('./assets/dist/css/'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(gulp.dest('./assets/dist/css/'))
    .pipe(browsersync.stream());
}

// vendor scripts
function vendorScripts() {
  return (
    gulp
    .src([
      './node_modules/bootstrap/dist/js/bootstrap.min.js',
      './node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
      './node_modules/slick-carousel/slick/slick.js',
      './node_modules/sticky-sidebar/dist/jquery.sticky-sidebar.min.js',
      './assets/src/js/**/*',
      ])
      .pipe(plumber())
      .pipe(concat('main.js'))
      .pipe(gulp.dest('./assets/dist/js/'))
      .pipe(babel({ presets: ['@babel/env'] }))
      .pipe(uglify())
      .pipe(rename({ suffix: '.min' }))
      .pipe(gulp.dest('./assets/dist/js/'))
      .pipe(browsersync.stream())
  );
}

// scripts
function scripts() {
  return (
    gulp
    .src([
      './node_modules/bootstrap/dist/js/bootstrap.min.js',
      './node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
      './node_modules/slick-carousel/slick/slick.js',
      './node_modules/sticky-sidebar/dist/jquery.sticky-sidebar.min.js',
      './assets/src/js/**/*',
      ])
    .pipe(plumber())
    .pipe(concat('main.js'))
    .pipe(gulp.dest('./assets/dist/js/'))
    .pipe(babel({ presets: ['@babel/env'] }))
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./assets/dist/js/'))
    .pipe(browsersync.stream())
  );
}

// fonts
function fonts() {
  return (
    gulp
      .src('./assets/src/fonts/**/*')
      .pipe(plumber())
      .pipe(gulp.dest('./assets/dist/fonts'))
      .pipe(browsersync.stream())
  );
}

// watch changes
function watchFiles() {
  gulp.watch('./assets/src/scss/**/*', css);
  gulp.watch('./assets/src/js/**/*', scripts);
  // gulp.watch('./assets/src/img/**/*', images);
  gulp.watch('./assets/src/fonts/**/*', fonts);
  gulp.watch('./*.html', html);
}

const start = gulp.series(clean, fonts, css, vendorScripts, scripts, html);
const watch = gulp.parallel(watchFiles, browserSync);

// export tasks
// exports.images = images;
exports.css = css;
exports.scripts = scripts;
exports.clean = clean;
exports.watch = watch;
exports.default = gulp.series(start, watch);
