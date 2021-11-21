const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { mainModule } = require('process');

module.exports = {
    entry: {
        app: './assets/index.js',
    },
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'assets/dist'),
        clean: true,
    },
    module: {
        rules: [
            {
                test:/\.s[ac]ss$/i,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: '',
                        },
                    },
                    'css-loader', 
                    'postcss-loader', 
                    'sass-loader'
                ],
            },
            // {
            //     test: /\.(png|svg|jpg|jpeg|gif)$/i,
            //     type: 'asset/resource',
            //     generator: {
            //         filename: 'assets/images/[hash][ext]'
            //     }
            // // },
            // {
            //     test: /\.(woff|woff2|eot|ttf|otf)$/i,
            //     type: 'asset/resource',
            //     generator: {
            //         filename: 'assets/fonts/[hash][ext]'
            //     }
            // },
            {
                test: /\.m?js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
        ],
    },
    plugins: [new MiniCssExtractPlugin({
        filename: 'main.css',
    })],
};