var fs = require("fs");
var browserify = require('browserify');
var vueify = require('vueify');

browserify("./assets/main.js")
	.transform(vueify)
  	.bundle()
  	.pipe(fs.createWriteStream("./public/js/main.js"));