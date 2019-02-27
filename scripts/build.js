const path = require("path");
const { PATHS } = require("../env.config");
const utils = require("./utils");
const webpack = require("webpack");
const fs = require("fs-extra");
const webpackConfig = require("../webpack.config");

const bundler = webpack(webpackConfig);

(async () => {
    try {
    // Production: Copy "style.css" to "style.tmp"
    await utils.addMainCss();
    // Remove "compiled" folder and run bundler
    await webpackBuild();
    // Copies everything into "build" directory
    await finalize();
    console.log("Done!");
    } catch (e) {
    console.log(e.toString());
    }
})();

async function webpackBuild()
{
    console.log("Running webpack build.");
    await fs.remove(PATHS.compiled());
    return new Promise((resolve, reject) => {
    bundler.run((err, stats) => (err ? reject(err) : resolve(stats)));
    });
}

async function finalize()
{
    console.log("Finalizing.");
    const buildDir = PATHS.base("build");

    // Remove existing "build" directory
    await fs.remove(buildDir);

    await fs.ensureDir(path.join(buildDir, "src"));

    await fs.ensureDir(path.join(buildDir, "wp-content/themes/cb/compiled"));
    await fs.copy(PATHS.compiled(), path.join(buildDir, "wp-content/themes/cb/compiled"));

    await fs.ensureDir(path.join(buildDir, "wp-content/plugins"));
    await fs.copy(PATHS.base+'/../../../plugins', path.join(buildDir, "wp-content/plugins"));

    // Get all files and directories except node_modules, build, compiled
    let allSrcFiles = await utils.getAllFilesInPath(PATHS.base());

    // Copy base dir to "build/src"
    allSrcFiles = allSrcFiles.map(f => {
        fs.copy(f, `${path.join(buildDir, "src")}/${f.replace(PATHS.base(), "")}`);
    });

    // Wait for all files to copy to "build/src"
    await Promise.all(allSrcFiles);

    // Get all php files
    let phpFiles = await utils.getFilesByExtension(PATHS.base(), "php");

    // Get all css files
    let cssFile = await utils.getFilesByExtension(PATHS.base(), "css");

    // Get screenshot.png
    let screenshotFile = await utils.getScreenshot(PATHS.base());

    // Concatenate all files
    let allFiles = phpFiles.concat(cssFile, screenshotFile);

    // Copy all files to "build" directory
    allFiles = allFiles.map(f => {
      fs.copy(f, `${path.join(buildDir, "wp-content/themes/cb")}/${f.replace(PATHS.base(), "")}`);
    }
);

    // Wait for all files to copy to "build" directory
    await Promise.all(allFiles);

    // Remove style.css
    await fs.remove(path.join(PATHS.base(), "style.css"));

    // Rename from "tmp" to "css"
    return await fs.rename(
    path.join(PATHS.base(), "style.tmp"),
    path.join(PATHS.base(), "style.css")
    );
}
