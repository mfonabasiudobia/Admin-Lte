/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/Http/Livewire/**/*Table.php",
        "./vendor/power-components/livewire-powergrid/resources/views/**/*.php",
        "./vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php",
        "./app/Http/**/*.php",
        "./vendor/usernotnull/tall-toasts/config/**/*.php",
        "./vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php",
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: "#04528B",
                light: "#F8F8FA",
                dark: "#2A2E37",
                link: "#0a66c2",
                success: "#00C292",
                danger: "#EA1D5D",
                warning: "#FEC107",
                info: "#03a9f3",
            },
        },
    },
    plugins: [],
};
