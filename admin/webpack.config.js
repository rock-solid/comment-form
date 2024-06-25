const path = require('path');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const extractSassBundle = new MiniCssExtractPlugin({
    filename: '[name].css',
});

module.exports = {
    entry: path.resolve(__dirname, 'assets/scripts/main.js'),
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'dist'),
    },
    plugins: [
        extractSassBundle,
    ],
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: [
                                    tailwindcss,
                                    autoprefixer(),
                                ],
                            },
                        },
                    }
                ]
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                    loader: 'postcss-loader',
                    options: {
                        postcssOptions: {
                                plugins: [
                                    tailwindcss,
                                    autoprefixer(),
                                ],
                            },
                        },
                    },
                    'sass-loader',
                ],
            },
            {
                test: [/\.bmp$/, /\.gif$/, /\.jpe?g$/, /\.png$/, /\.svg$/],
                exclude: [/fonts/],
                type: 'asset/resource',
                generator : {
                    filename : 'images/[name][ext][query]',
                }
            },
        ],
    },
    optimization: {
        minimize: true,
    },
};