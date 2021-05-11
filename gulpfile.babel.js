import webpack from "webpack-stream";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import autoprefixer from "autoprefixer";
import pkg from "gulp";
const { src, dest, watch, series } = pkg;
import sass from "gulp-sass";
import cleanCss from "gulp-clean-css";
import browserSync from "browser-sync";
import wpPot from "gulp-wp-pot";

// Translation File

export const pot = () => {
  return src("**/*.php")
    .pipe(
      wpPot({
        domain: "namehere",
      })
    )
    .pipe(dest(`languages/namehere.pot`));
};

// Style Compile

export const styles = () => {
  return src("assets/dev/scss/main.scss")
    .pipe(sourcemaps.init())
    .pipe(sass().on("error", sass.logError))
    .pipe(postcss([autoprefixer]))
    .pipe(cleanCss({ compatibility: "ie8" }))
    .pipe(sourcemaps.write())
    .pipe(dest("assets/css"))
    .pipe(server.stream());
};

// JS Compile

export const scripts = () => {
  return src(["assets/dev/js/main.js"])
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: "babel-loader",
              },
            },
          ],
        },
        mode: "production",
        devtool: false,
        output: {
          filename: "[name].min.js",
        },
      })
    )
    .pipe(dest("assets/js"));
};

// BrowserSync

const server = browserSync.create();

export const serve = (done) => {
  server.init({
    proxy: "https://namehere.de", // put your local link
  });
  done();
};

export const reload = (done) => {
  server.reload();
  done();
};

// Watch

export const watching = () => {
  watch("assets/dev/scss/*.scss", styles);
  watch("assets/dev/js/**/*.js", series(scripts, reload));
  watch("**/*.php", reload);
};

export const launch = series(serve, watching);
export default launch;
