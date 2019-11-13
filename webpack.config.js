const path = require('path');

const NODE_ENV = process.env.NODE_ENV || 'development';

module.exports = {
  entry: {
    index: './raw_code/js/index.js',
    content: './raw_code/js/content.js',
    about: './raw_code/js/about.js',
  },
  output: {
    path: path.resolve(__dirname, 'public_html/js'),
    filename: "[name].js"
  },
  /*
  watch: NODE_ENV === 'development',
  watchOptions: {
    aggregateTimeout: 100
  }
  */
};
