const ExtractTextPlugin = require('extract-text-webpack-plugin');
const production = process.env.NODE_ENV === 'production';

module.exports = {
	entry: {
		'customizer': './src/customizer.js',
		'frontend': './src/frontend.js',
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				use: 'babel-loader',
			},
			{
				test: /\.(scss|css|sass)$/,
				use: ExtractTextPlugin.extract({
					use: [
						{
							loader: 'css-loader',
							options: {
								minimize: production,
							},
						},
						{
							loader: 'sass-loader',
						},
					],
				}),
			},
		],
	},
	mode: production ? 'production' : 'development',
	plugins: [
		new ExtractTextPlugin('frontend.css'),
	],
}
