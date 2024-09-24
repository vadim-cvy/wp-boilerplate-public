const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const path = require('path');

const srcDir = './assets/src/css';
const distDir = './assets/dist/css';

gulp.task('scss', () => {
  return gulp
    .src(path.join(srcDir, '/**/index.scss'))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(distDir));
});

gulp.task('watch', () => gulp.watch(
  srcDir + '/**/*.scss',
  done => gulp.series(['scss'])(done)
))