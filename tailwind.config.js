import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    daisyui: {
		themes: [
			{
				dark: {
					"primary": "#641ae6",
					"secondary": "#181818",
					"secondary-content": "#212020",
					"accent": "#f8f8f8",
					"neutral": "#111111",
					"base-100": "#0e0e0e",
					"base-300": "#000000",
					"info": "#3abff8",
					"success": "#16a34a",
					"warning": "#fbbd23",
					"error": "#f87272",
				},
				light: {
					"primary": "#641ae6",
					"secondary": "#e7e5e4",
					"secondary-content": "#fbfbfb",
					"accent": "#070707",
					"neutral": "#d6d3d1",
					"base-100": "#f5f5f4",
					"base-300": "#f5f5f4",
					"info": "#3abff8",
					"success": "#16a34a",
					"warning": "#fbbd23",
					"error": "#f87272",
				},
			},
		],
	},

	theme: {
		extend: {
			fontFamily: {
				'sans': ['Inter', ...defaultTheme.fontFamily.sans],
			},
		}
	},

    plugins: [forms, typography, daisyui],
};
