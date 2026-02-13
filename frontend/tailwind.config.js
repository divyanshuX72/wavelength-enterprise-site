/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./*.html", "./assets/js/**/*.js"],
    theme: {
        extend: {
            colors: {
                wood: '#7b4f2a',
                'wood-dark': '#1a120b',
                muted: '#9ca3af'
            },
            fontFamily: {
                sans: ['Outfit', 'sans-serif'],
            }
        },
    },
    plugins: [],
}
