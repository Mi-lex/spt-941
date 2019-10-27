const mix = require('laravel-mix');
const fs = require('fs');

const getFiles = dir => (
    // get all 'files' in this directory
    // filter directories
    fs.readdirSync(dir).filter(file =>
        fs.statSync(`${dir}/${file}`).isFile()
    )
);

// Js pages
getFiles('resources/js/pages').forEach(function (filename) {
    mix.js('resources/js/pages/' + filename, 'public/js/pages');
});

mix.sass('resources/sass/app.scss', 'public/css')
    .copy('resources/img', 'public/img');
