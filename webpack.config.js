var PACKAGE = require('./package.json');
var version = PACKAGE.version;

const path = require('path');

const HtmlWebPackPlugin = require("html-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const {
    CleanWebpackPlugin
} = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');



module.exports = {


    entry: {
        'main': path.resolve(__dirname, '/src/js/index.js'),
        '404': path.resolve(__dirname, '/src/js/404.js'),
    },
    output: {
        path: path.resolve(__dirname, './dist'),
        filename: './js/[name].' + PACKAGE.version + '.js',
    },

    module: {

        rules: [{
            test: /\.html$/,
            use: [{
                loader: "html-loader",
                options: {
                    minimize: true
                }
            }]
        },

        {
            test: [/\.js$/, /\.jsx?$/],
            exclude: /node_modules/,
            loader: 'babel-loader',
            options: {
                presets: ['@babel/env'],
                plugins: ['@babel/plugin-transform-runtime'],
            },
        },

        {
            test: /\.(sa|sc|c)ss$/,
            use: [{
                loader: MiniCssExtractPlugin.loader,
                options: {
                    publicPath: './dist/'
                }
            },
            {
                loader: 'css-loader',
                options: {
                    importLoaders: 1
                }
            },
            {
                loader: 'sass-loader',
                options: {}
            },
            ],
        },

        {
            test: /\.(woff|woff2|eot|ttf)$/,
            use: [{
                loader: 'file-loader',
                options: {
                    name: '[name].[ext]',
                    useRelativePath: true,
                    outputPath: "./fonts/",
                }
            }]
        },



        {
            test: /\.(png|jpe?g|gif|svg)$/i,
            use: [{
                loader: 'file-loader',
                options: {
                    name: '[name].[ext]',
                    useRelativePath: true,
                    outputPath: "./assets/images",
                }
            },],
        },
        ]
    },



    plugins: [

        new MiniCssExtractPlugin({
            filename: '../style.css',
            chunkFilename: '../style.css'
        }),

        new CleanWebpackPlugin()
    ]
}