import forms from "@tailwindcss/forms"
import defaultTheme from "tailwindcss/defaultTheme"
import preset from './vendor/filament/support/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    presets: [preset],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.tsx",
        "node_modules/preline/dist/*.js"
    ],

    theme: {
        extend: {
            colors: {
                custom: {
                    50: 'rgba(var(--c-50), var(--tw-text-opacity))',
                    100: 'rgba(var(--c-100), var(--tw-text-opacity))',
                    200: 'rgba(var(--c-200), var(--tw-text-opacity))',
                    300: 'rgba(var(--c-300), var(--tw-text-opacity))',
                    400: 'rgba(var(--c-400), var(--tw-text-opacity))',
                    500: 'rgba(var(--c-500), var(--tw-text-opacity))',
                    600: 'rgba(var(--c-600), var(--tw-text-opacity))',
                },
                danger: {
                    50: "rgba(var(--danger-50), var(--tw-text-opacity))",
                    100: "rgba(var(--danger-100), var(--tw-text-opacity))",
                    200: "rgba(var(--danger-200), var(--tw-text-opacity))",
                    300: "rgba(var(--danger-300), var(--tw-text-opacity))",
                    400: "rgba(var(--danger-400), var(--tw-text-opacity))",
                    500: "rgba(var(--danger-500), var(--tw-text-opacity))",
                    600: "rgba(var(--danger-600), var(--tw-text-opacity))",
                    700: "rgba(var(--danger-700), var(--tw-text-opacity))",
                    800: "rgba(var(--danger-800), var(--tw-text-opacity))",
                    900: "rgba(var(--danger-900), var(--tw-text-opacity))",
                    950: "rgba(var(--danger-950), var(--tw-text-opacity))",
                },
                gray: {
                    50: "rgba(var(--gray-50), var(--tw-text-opacity))",
                    100: "rgba(var(--gray-100), var(--tw-text-opacity))",
                    200: "rgba(var(--gray-200), var(--tw-text-opacity))",
                    300: "rgba(var(--gray-300), var(--tw-text-opacity))",
                    400: "rgba(var(--gray-400), var(--tw-text-opacity))",
                    500: "rgba(var(--gray-500), var(--tw-text-opacity))",
                    600: "rgba(var(--gray-600), var(--tw-text-opacity))",
                    700: "rgba(var(--gray-700), var(--tw-text-opacity))",
                    800: "rgba(var(--gray-800), var(--tw-text-opacity))",
                    900: "rgba(var(--gray-900), var(--tw-text-opacity))",
                    950: "rgba(var(--gray-950), var(--tw-text-opacity))",
                },
                info: {
                    50: "rgba(var(--info-50), var(--tw-text-opacity))",
                    100: "rgba(var(--info-100), var(--tw-text-opacity))",
                    200: "rgba(var(--info-200), var(--tw-text-opacity))",
                    300: "rgba(var(--info-300), var(--tw-text-opacity))",
                    400: "rgba(var(--info-400), var(--tw-text-opacity))",
                    500: "rgba(var(--info-500), var(--tw-text-opacity))",
                    600: "rgba(var(--info-600), var(--tw-text-opacity))",
                    700: "rgba(var(--info-700), var(--tw-text-opacity))",
                    800: "rgba(var(--info-800), var(--tw-text-opacity))",
                    900: "rgba(var(--info-900), var(--tw-text-opacity))",
                    950: "rgba(var(--info-950), var(--tw-text-opacity))",
                },
                primary: {
                    50: "rgba(var(--primary-50), var(--tw-text-opacity))",
                    100: "rgba(var(--primary-100), var(--tw-text-opacity))",
                    200: "rgba(var(--primary-200), var(--tw-text-opacity))",
                    300: "rgba(var(--primary-300), var(--tw-text-opacity))",
                    400: "rgba(var(--primary-400), var(--tw-text-opacity))",
                    500: "rgba(var(--primary-500), var(--tw-text-opacity))",
                    600: "rgba(var(--primary-600), var(--tw-text-opacity))",
                    700: "rgba(var(--primary-700), var(--tw-text-opacity))",
                    800: "rgba(var(--primary-800), var(--tw-text-opacity))",
                    900: "rgba(var(--primary-900), var(--tw-text-opacity))",
                    950: "rgba(var(--primary-950), var(--tw-text-opacity))",
                },
                success: {
                    50: "rgba(var(--success-50), var(--tw-text-opacity))",
                    100: "rgba(var(--success-100), var(--tw-text-opacity))",
                    200: "rgba(var(--success-200), var(--tw-text-opacity))",
                    300: "rgba(var(--success-300), var(--tw-text-opacity))",
                    400: "rgba(var(--success-400), var(--tw-text-opacity))",
                    500: "rgba(var(--success-500), var(--tw-text-opacity))",
                    600: "rgba(var(--success-600), var(--tw-text-opacity))",
                    700: "rgba(var(--success-700), var(--tw-text-opacity))",
                    800: "rgba(var(--success-800), var(--tw-text-opacity))",
                    900: "rgba(var(--success-900), var(--tw-text-opacity))",
                    950: "rgba(var(--success-950), var(--tw-text-opacity))",
                },
                warning: {
                    50: "rgba(var(--warning-50), var(--tw-text-opacity))",
                    100: "rgba(var(--warning-100), var(--tw-text-opacity))",
                    200: "rgba(var(--warning-200), var(--tw-text-opacity))",
                    300: "rgba(var(--warning-300), var(--tw-text-opacity))",
                    400: "rgba(var(--warning-400), var(--tw-text-opacity))",
                    500: "rgba(var(--warning-500), var(--tw-text-opacity))",
                    600: "rgba(var(--warning-600), var(--tw-text-opacity))",
                    700: "rgba(var(--warning-700), var(--tw-text-opacity))",
                    800: "rgba(var(--warning-800), var(--tw-text-opacity))",
                    900: "rgba(var(--warning-900), var(--tw-text-opacity))",
                    950: "rgba(var(--warning-950), var(--tw-text-opacity))",
                },
                border: "hsl(var(--border))",
                input: "hsl(var(--input))",
                ring: "hsl(var(--ring))",
                background: "hsl(var(--background))",
                foreground: "hsl(var(--foreground))",
                /* primary: {
                     DEFAULT: "hsl(var(--primary))",
                     foreground: "hsl(var(--primary-foreground))",
                 },*/
                secondary: {
                    DEFAULT: "hsl(var(--secondary))",
                    foreground: "hsl(var(--secondary-foreground))",
                },
                destructive: {
                    DEFAULT: "hsl(var(--destructive))",
                    foreground: "hsl(var(--destructive-foreground))",
                },
                muted: {
                    DEFAULT: "hsl(var(--muted))",
                    foreground: "hsl(var(--muted-foreground))",
                },
                accent: {
                    DEFAULT: "hsl(var(--accent))",
                    foreground: "hsl(var(--accent-foreground))",
                },
                popover: {
                    DEFAULT: "hsl(var(--popover))",
                    foreground: "hsl(var(--popover-foreground))",
                },
                card: {
                    DEFAULT: "hsl(var(--card))",
                    foreground: "hsl(var(--card-foreground))",
                },
                'iut-green': '#008751',
                'iut-yellow': '#fcd116',
                'iut-red': '#e8001e',
            },
            borderRadius: {
                lg: `var(--radius)`,
                md: `calc(var(--radius) - 2px)`,
                sm: "calc(var(--radius) - 4px)",
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                "accordion-down": {
                    from: {height: 0},
                    to: {height: "var(--radix-accordion-content-height)"},
                },
                "accordion-up": {
                    from: {height: "var(--radix-accordion-content-height)"},
                    to: {height: 0},
                },
            },
            animation: {
                "accordion-down": "accordion-down 0.2s ease-out",
                "accordion-up": "accordion-up 0.2s ease-out",
            },
        },
    },

    plugins: [
        forms,
        require("tailwindcss-animate"),
        require('preline/plugin'),
        require('@tailwindcss/forms'),
    ],
}
