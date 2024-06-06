/** @type {import('tailwindcss').Config} */
const plugin = require("tailwindcss/plugin");
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    darkMode: "class",
    theme: {},
    plugins: [
        plugin(function ({ addVariant }) {
            addVariant("group-dashboard", ":merge(.group).dashboard &");
        }),
        require("flowbite/plugin"),
    ],
};
