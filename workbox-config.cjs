module.exports = {
	globDirectory: 'public/',
	globPatterns: [
		'**/*.{js,css,json,ico,php,txt}'
	],
	swDest: 'public/sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};