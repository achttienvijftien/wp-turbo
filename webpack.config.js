const path = require('node:path');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const {WebpackManifestPlugin} = require('webpack-manifest-plugin');

module.exports = {
    entry: {
        runtime: './assets/runtime.js'
    },
    output: {
        path: path.resolve(__dirname, 'dist/'),
        publicPath: '/app/mu-plugins/wp-turbo/dist/',
        filename: '[name].[contenthash].js',
    },
    plugins: [
        new CleanWebpackPlugin(),
        new WebpackManifestPlugin(),
    ],
    module: {
        rules: [
            {
                test: /\.(?:js|mjs|cjs)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }
        ]
    }
};
