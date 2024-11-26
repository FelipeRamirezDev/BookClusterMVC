import { src, dest, watch, series } from 'gulp';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import sourcemaps from 'gulp-sourcemaps';
import cleanCSS from 'gulp-clean-css';
import concat from 'gulp-concat';
import terser from 'gulp-terser';

// Configuración de Sass
const sass = gulpSass(dartSass);

// Rutas
const paths = {
  scss: './src/scss/**/*.scss',
  js: './src/js/**/*.js',
  cssOutput: './public/css',
  jsOutput: './public/js',
};

// Tareas
function compileSCSS() {
  return src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ cascade: false }))
    .pipe(concat('styles.min.css')) // Combina todos los SCSS compilados en un único archivo
    .pipe(cleanCSS()) // Minifica el CSS
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.cssOutput)); // Guarda el archivo combinado en la carpeta de salida
}

function minifyJS() {
  return src(paths.js)
    .pipe(sourcemaps.init())
    .pipe(concat('bundle.min.js')) // Combina todos los JS en un único archivo
    .pipe(terser()) // Minifica el JavaScript
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.jsOutput)); // Guarda el archivo combinado en la carpeta de salida
}

function watchFiles() {
  watch(paths.scss, compileSCSS);
  watch(paths.js, minifyJS);
}

// Exporta las tareas por defecto
export default series(compileSCSS, minifyJS, watchFiles);
