const gulp = require('gulp');
const browser = require('browser-sync').create();
const autoprefixer = require('gulp-autoprefixer');
const sassPkg = require('gulp-sass');
const sassCompiler = require('sass');
const sourcemaps = require('gulp-sourcemaps');
const sortMediaQueries = require('postcss-sort-media-queries');
const postcss = require('gulp-postcss');
const flatten = require('gulp-flatten');
const newer = require('gulp-newer');
const del = require('del');
const path = require('path');

const sass = sassPkg(sassCompiler);

const devDir = './public/kawazu/';
const localwp =
    'D:/jline/2025/22_kawazu_sangyou/kiwazuwp/wp-content/themes/kawazu';
const src = './src/';

function style() {
    const processors = [sortMediaQueries({ sort: 'desktop-first' })];
    return gulp
        .src(src + 'scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
        .pipe(autoprefixer({ cascade: false }))
        .pipe(postcss(processors))
        .pipe(flatten())
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(devDir + 'assets/css'))
        .pipe(browser.stream());
}

function syncToLocalWP() {
    return gulp
        .src(devDir + '**/*', { base: devDir })
        .pipe(newer(localwp))
        .pipe(gulp.dest(localwp));
}

function handleDelete(filePath) {
    const relativePath = path.relative(devDir, filePath);
    const targetPath = path.join(localwp, relativePath);
    return del(targetPath, { force: true });
}

//Serve + Watch
function serve() {
    browser.init({
        server: devDir,
    });

    gulp.watch(src + 'scss/**/*.scss', gulp.series(style, syncToLocalWP));
    gulp.watch(devDir + '**/*.html').on('change', browser.reload);
    gulp.watch(devDir + '**/*.php', gulp.series(syncToLocalWP));
    gulp.watch(devDir + '**/images/**/*.*').on('change', browser.reload);
    gulp.watch(devDir + '**/*.js').on('change', browser.reload);

    const watcher = gulp.watch(devDir + '**/*', gulp.series(syncToLocalWP));
    watcher.on('unlink', (filePath) => {
        console.log('🗑 Xoá file:', filePath);
        handleDelete(filePath);
    });
    watcher.on('unlinkDir', (dirPath) => {
        handleDelete(dirPath);
    });
}

exports.default = gulp.series(style, syncToLocalWP, serve);

//convert image to webp
gulp.task('convertwebp', async function () {
    const webp = (await import('gulp-webp')).default;
    return gulp
        .src(src + 'images/**/*.{jpg,jpeg,png}')
        .pipe(webp({ quality: 90 }))
        .pipe(gulp.dest(devDir + 'assets/images/'));
});

//copy svg
gulp.task('copysvg', function () {
    return gulp
        .src(src + 'images/**/*.svg')
        .pipe(gulp.dest(devDir + 'assets/images/'));
});

gulp.task('img', gulp.series('convertwebp', 'copysvg'));
