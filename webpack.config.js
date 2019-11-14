const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserJSPlugin = require('terser-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const NODE_ENV = process.env.NODE_ENV || 'development';
const publicPath = '/';

module.exports = {
  context: __dirname + '/src/js',
  entry: {
    index: './index.js',
    content: './content.js',
    about: './about.js',
  },
  output: {
    path: path.resolve(__dirname, 'public_html'),
    filename: 'js/[name].js',
    publicPath: publicPath,
  },
  watch: false,
  watchOptions: {
    aggregateTimeout: 300,
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
      chunkFilename: 'css/[id].css',
    }),
  ],
  optimization: {
    noEmitOnErrors: true,
    minimizer: [new TerserJSPlugin({}), new OptimizeCSSAssetsPlugin({})],
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', ],
      },
    ],
  },
};

if (NODE_ENV === 'production') {
  module.exports.plugins.push(
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        warnings: false,
        drop_console: true,
      },
    })
  );
}
