const { src, dest, watch , parallel } = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('autoprefixer');
const postcss    = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const webp = require('gulp-webp');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

const pathsAdmin = {

    scss: 'admin/src/scss/**/*.scss',
    js: 'admin/src/js/**/*.js',
    imagenes: 'admin/src/img/**/*'

}

// css es una función que se puede llamar automaticamente
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe( dest('./ventas-jaure/build/css') );
}


function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js')) // final output file name
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./ventas-jaure/build/js'))
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest('./ventas-jaure/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe( webp() )
        .pipe(dest('./ventas-jaure/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}


function watchArchivos() {
    watch( paths.scss, css );
    watch( paths.js, javascript );
    watch( paths.imagenes, imagenes );
    watch( paths.imagenes, versionWebp );
}
// css es una función que se puede llamar automaticamente


//________________________________________________//////////////////

function cssAdmin() {
    return src(pathsAdmin.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe( dest('./admin/build/css') );
}


function javascriptAdmin() {
    return src(pathsAdmin.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js')) // final output file name
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./admin/build/js'))
}

function imagenesAdmin() {
    return src(pathsAdmin.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest('./admin/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}

function versionWebpAdmin() {
    return src(pathsAdmin.imagenes)
        .pipe( webp() )
        .pipe(dest('./admin/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}


function watchArchivosAdmin() {
    watch( pathsAdmin.scss, cssAdmin );
    watch( pathsAdmin.js, javascriptAdmin );
    watch( pathsAdmin.imagenes, imagenesAdmin );
    watch( pathsAdmin.imagenes, versionWebpAdmin );
}

exports.default = parallel(css, javascript,  imagenes, versionWebp, watchArchivos, cssAdmin, javascriptAdmin, imagenesAdmin, versionWebpAdmin, watchArchivosAdmin);
