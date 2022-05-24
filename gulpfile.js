const {
	series
} = require('gulp');
const {
	src,
	dest
} = require('gulp');

const gulp = require('gulp');
const imagemin = require('gulp-imagemin')
// const minify = require('gulp-minify');
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')
const inject = require('gulp-inject-string');

function compressImages() {
	return gulp
		.src('./dist/assets/images/*.*')
		.pipe(imagemin([
			imagemin.mozjpeg({
				progressive: true
			}),
			imagemin.optipng({
				optimizationLevel: 5
			}),
		]))
		.pipe(gulp.dest('./dist/assets/images/'))
}

function cssAutoprefixer() {
	var plugins = [
		autoprefixer({
			grid: true
		})
	];
	return gulp.src('./*.css')
		.pipe(postcss(plugins))
		.pipe(gulp.dest('./'));
}

function cssCompress() {
	var plugins = [
		autoprefixer({
			grid: true
		}),
		cssnano()
	];
	return gulp.src('./*.css')
		.pipe(postcss(plugins))
		.pipe(gulp.dest('./'));
}

function injectString() {

	return gulp.src('./style.css')
		.pipe(inject.prepend('/* Theme Name: Beauty To Retail\n Author: Aivars\n Version: 1.0 */'))
		.pipe(gulp.dest('./'));
}


// Default
exports.default = series(compressImages);

// Scripts
exports.build = series(cssAutoprefixer, cssCompress, injectString);