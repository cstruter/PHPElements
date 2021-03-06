var gulp = require('gulp'),
	jsdoc = require('gulp-jsdoc3'),
	uglify = require('gulp-uglify'),
    uglifycss = require('gulp-uglifycss'),
    concat = require('gulp-concat');	

gulp.task('documentation', function (cb) {
    gulp.src([
			'Scripts/CSTruter.Elements.js',
			'Scripts/CSTruter.Elements.DropDownList.js',
			'Scripts/CSTruter.Elements.TreeView.js'], {read: false})
        .pipe(jsdoc(cb));
});


gulp.task('minify-js', function () {
    return gulp.src([
			'Scripts/CSTruter.Elements.js',
			'Scripts/CSTruter.Elements.DropDownContainer.js',
			'Scripts/CSTruter.Elements.CheckBoxList.js',
			'Scripts/CSTruter.Elements.DropDownList.js',
			'Scripts/CSTruter.Elements.TreeView.js']).
		pipe(concat('CSTruter.Elements.min.js')).
		pipe(uglify()).
		pipe(gulp.dest('Scripts/'));
});

gulp.task('minify-css', function () {
    return gulp.src([
			'Styles/CSTruter.Elements.css',
			'Styles/CSTruter.Elements.TreeView.css',
			'Styles/CSTruter.Elements.TreeView-Responsive.css',
			'Styles/CSTruter.Elements.CheckBoxList.css',
			'Styles/CSTruter.Elements.DropDownContainer.css',
			'Styles/CSTruter.Elements.DropDownCheckBoxList.css']).
		pipe(concat('CSTruter.Elements.min.css')).
		pipe(uglifycss()).
		pipe(gulp.dest('Styles/'));
});

gulp.task('default', ['minify-js', 'minify-css', 'documentation']);