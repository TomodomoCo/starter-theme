/**
 * Load Gulp and Gulp-adjacent dependencies
 */
const gulp           = require('gulp')
const gutil          = require('gulp-util')
const concat         = require('gulp-concat')
const cssnano        = require('gulp-cssnano')
const eyeglass       = require('eyeglass')
const imagemin       = require('gulp-imagemin')
const minimist       = require('minimist')
const sass           = require('gulp-sass')
const sassAssetFuncs = require('node-sass-asset-functions')
const sassglob       = require('gulp-sass-glob')
const sourcemaps     = require('gulp-sourcemaps')
const svgo           = require('gulp-svgo')
const svgSprite      = require('gulp-svg-sprite')
const uglify         = require('gulp-uglify')
const webpack        = require('webpack-stream')

var options = minimist(process.argv.slice(2), {
  string: 'env',
  default: {
    env: process.env.NODE_ENV || 'production'
  },
})

/**
 * Sass to CSS compilation, minification, and prefixing
 */
gulp.task('css', () => {
  const sassConfig = {
    functions: sassAssetFuncs({
      'images_path':      'build/assets/img/',
      'http_images_path': '../img/',
      'fonts_path':       'build/assets/fonts/',
      'http_fonts_path':  '../fonts/',
    }),
    includePaths: [
      './node_modules',
    ],
  }

  let stream = gulp.src('src/assets/sass/*.scss')
    .pipe(sassglob())
    .pipe(sourcemaps.init())
    .pipe(sass(eyeglass(sassConfig)).on('error', sass.logError))
    .pipe(cssnano({
      autoprefixer: {
        browsers: ['last 2 versions'],
        cascade: false,
      },
      discardComments: {
        removeAll: true,
      },
      zindex: false,
    }))

  // Write sourcemaps if we're outside of production
  stream = (options.env === 'production')
    ? stream
    : stream.pipe(sourcemaps.write())

  // Write the output
  stream.pipe(gulp.dest('build/assets/css/'))
})

/**
 * Font placement
 */
gulp.task('fonts', () => {
  gulp.src('src/assets/fonts/**/*')
    .pipe(gulp.dest('build/assets/fonts/'))
})

/**
 * Image minification
 */
gulp.task('images', () => {
  gulp.src('src/assets/img/**/*')
    .pipe(imagemin({
      progressive: true,
      multipass: true,
    }))
    .pipe(gulp.dest('build/assets/img/'))
})

/**
 * Spritify SVGs
 */
gulp.task('sprites', () => {
  gulp.src('src/assets/sprites/**/*.svg')
    .pipe(svgSprite({
      mode: {
        symbol: true
      }
    }))
    .pipe(gulp.dest('build/assets/sprites'))
})

/**
 * Handle normal SVGs
 */
gulp.task('svg', () => {
  gulp.src('src/assets/svg/**/*.svg')
    .pipe(svgo())
    .pipe(gulp.dest('build/assets/img'))
})

/**
 * JavaScript compilation
 */
gulp.task('js', () => {
  // Grab the config file
  let webpackConfig = require('./webpack.config.js')

  gulp.src('src/assets/js/index.js')
    .pipe(webpack(webpackConfig[options.env]))
    .pipe(gulp.dest('build/assets/js/'))
})

/**
 * Watch filesystem for changes
 */
gulp.task('watcher', () => {
  const isWatching = true

  gulp.watch('src/assets/sass/**/*.scss',   ['css'])
  gulp.watch('src/assets/fonts/**/*',       ['fonts'])
  gulp.watch('src/assets/img/**/*',         ['images'])
  gulp.watch('src/assets/svg/**/*',         ['svg'])
  gulp.watch('src/assets/sprites/**/*.svg', ['sprites'])
})

/**
 * Set up default task
 */
gulp.task('default', [
  'images',
  'svg',
  'sprites',
  'js',
  'fonts',
  'css',
])

/**
 * Set up watch task
 */
gulp.task('watch', [
  'default',
  'watcher',
])
