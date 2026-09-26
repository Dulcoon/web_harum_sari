import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Brand (homepage + admin)
                primary: '#d46211',
                'primary-dark': '#b0510e',
                'primary-deep': '#994200',
                sand: '#9a6c4c',
                accent: '#d46211',
                'background-light': '#f3efeb',
                'background-dark': '#1a0f0a',

                // Auth / material tokens
                'surface-container-low': '#f6f3f1',
                'surface-container': '#f0edeb',
                'secondary-container': '#e5ded9',
                'tertiary-container': '#837163',
                secondary: '#625e5a',
                'primary-fixed': '#ffdbca',
                'inverse-surface': '#31302f',
                'surface-dim': '#dcd9d8',
                'surface-tint': '#9d4400',
                'inverse-primary': '#ffb68f',
                'on-secondary-fixed-variant': '#4a4642',
                'on-background': '#1b1c1b',
                surface: '#fcf9f7',
                'on-tertiary-fixed-variant': '#534438',
                'surface-container-highest': '#e5e2e0',
                'primary-fixed-dim': '#ffb68f',
                'surface-container-lowest': '#ffffff',
                'outline-variant': '#dec0b2',
                'tertiary-fixed': '#f5dece',
                'on-secondary': '#ffffff',
                'on-primary-fixed-variant': '#773200',
                'error-container': '#ffdad6',
                'secondary-fixed-dim': '#ccc5c0',
                'inverse-on-surface': '#f3f0ee',
                'surface-container-high': '#eae8e6',
                'on-error-container': '#93000a',
                'surface-variant': '#e5e2e0',
                'on-primary': '#ffffff',
                error: '#ba1a1a',
                'on-secondary-fixed': '#1e1b18',
                'on-surface-variant': '#574238',
                tertiary: '#69594c',
                'on-secondary-container': '#66625e',
                'on-primary-container': '#fffbff',
                'surface-bright': '#fcf9f7',
                'on-tertiary-fixed': '#25190f',
                'on-primary-fixed': '#331100',
                'on-surface': '#1b1c1b',
                'tertiary-fixed-dim': '#d8c3b2',
                'primary-container': '#c05500',
                'secondary-fixed': '#e8e1dc',
                outline: '#8b7266',
                background: '#fcf9f7',
                'on-tertiary-container': '#fffbff',
                'on-error': '#ffffff',
                'on-tertiary': '#ffffff',
            },
            backgroundImage: {
                'premium-gradient': 'linear-gradient(135deg, #e67e22 0%, #d46211 100%)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Manrope', 'sans-serif'],
                body: ['Inter', 'sans-serif'],
                headline: ['Manrope', 'sans-serif'],
                label: ['Inter', 'sans-serif'],
                serif: ['"Playfair Display"', 'Georgia', 'serif'],
            },
            // Radius uses CSS variables so the homepage can keep its large radii
            // while admin/auth keep Tailwind defaults.
            borderRadius: {
                none: '0px',
                sm: '0.125rem',
                DEFAULT: 'var(--radius-default, 0.25rem)',
                md: '0.375rem',
                lg: 'var(--radius-lg, 0.5rem)',
                xl: 'var(--radius-xl, 0.75rem)',
                '2xl': 'var(--radius-2xl, 1rem)',
                '3xl': 'var(--radius-3xl, 1.5rem)',
                full: '9999px',
            },
            boxShadow: {
                warm: '0 20px 40px -15px rgba(212, 98, 17, 0.3)',
            },
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin'),
    ],
};
