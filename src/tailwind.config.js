const defaultTheme = require('tailwindcss/defaultTheme')
module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
	],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
			},
			borderColor: theme => ({
				DEFAULT: theme('colors.gray.200', 'currentColor'),
			}),
			boxShadow: theme => ({
				outline: '0 0 0 2px ' + theme('colors.indigo.500'),
			}),
			fill: theme => theme('colors'),
		},
	},
	variants: {
		extend: {
			fill: ['focus', 'group-hover'],
		},
	},
	plugins: [
		require('@tailwindcss/forms')
	],
}
