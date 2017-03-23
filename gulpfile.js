var gulp = require('gulp'),
	plumber= require('gulp-plumber'),
	sass = require('gulp-sass');

var paths = {
	sass_src : "assets/sass",
	sass_dest : "assets/css"
}



//sass task 
gulp.task('sass',function(){
	console.log("on sass task");
	gulp.src(paths.sass_src+"/**/*.scss")
		.pipe(plumber())
		.pipe(sass())
		.pipe(gulp.dest(paths.sass_dest));

});

//gulp watch task
gulp.task('watch',function(){
	gulp.watch('**/*.scss',['sass']);
});

//default task
gulp.task('default',['sass','watch']);