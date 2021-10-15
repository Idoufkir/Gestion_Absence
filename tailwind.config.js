module.exports = {
  purge: [
    './resources/**/*.blade.php',
     './resources/**/*.js',
     './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      tableLayout: ['hover', 'focus'],
      display: ['responsive', 'group-hover', 'group-focus'],
    },
  },
  plugins: [],
  corePlugins: {
    // ...
   tableLayout: false,
  }
}
