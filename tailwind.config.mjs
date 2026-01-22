/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}'],
  theme: {
    extend: {
      colors: {
        accent: {
          DEFAULT: '#f97316', // orange-500
          light: '#fb923c', // orange-400
          dark: '#ea580c', // orange-600
        }
      }
    },
  },
  plugins: [],
}
