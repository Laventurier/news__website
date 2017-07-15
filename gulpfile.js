const gulp = require('gulp');
const sass = require('gulp-sass');

  gulp.task('scss', function() {
      return gulp.src('app/scss/**/*.scss')
          .pipe(sass())
          .pipe(gulp.dest('app/css'))
  });

  gulp.task('scss-watch',function() {
      gulp.watch('app/scss/**/*.scss',['scss']);
  });
