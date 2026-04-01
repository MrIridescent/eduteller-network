/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'edu-mentor': '#3B82F6', // Trust, Guidance
        'edu-hero': '#F59E0B',   // Ambition, Growth
        'edu-ordeal': '#EF4444', // Conflict, Challenge
        'edu-elixir': '#10B981', // Mastery, Completion
        'edu-paper': '#F9FAFB',  // Clean writing surface
        'edu-ink': '#111827',    // Deep contrast for readability
      },
      boxShadow: {
        'narrative': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
        'hero': '0 20px 25px -5px rgba(245, 158, 11, 0.1), 0 10px 10px -5px rgba(245, 158, 11, 0.04)',
      },
      backgroundImage: {
        'narrative-gradient': 'linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(249,250,251,1) 100%)',
        'hero-glow': 'radial-gradient(circle, rgba(245,158,11,0.1) 0%, rgba(255,255,255,0) 70%)',
      },
      fontFamily: {
        'narrative': ['Lora', 'serif'], // For story text
        'interface': ['Inter', 'sans-serif'], // For UI elements
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-out',
        'slide-up': 'slideUp 0.5s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
