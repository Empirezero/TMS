/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", "sans-serif"],
            },
            colors: {
                konza: {
                    green: {
                        50: "#ecfdf5",
                        100: "#d1fae5",
                        200: "#a7f3d0",
                        300: "#6ee7b7",
                        400: "#34d399",
                        500: "#10b981",
                        600: "#059669",
                        700: "#166534",
                        800: "#065f46",
                        900: "#064e3b",
                    },
                    red: {
                        50: "#FDEDEC",
                        100: "#FAD1CE",
                        200: "#F3A29C",
                        300: "#EC6F63",
                        400: "#E64A3A",
                        500: "#E2251D",
                        600: "#C41F17",
                        700: "#A11A13",
                        800: "#7E140F",
                        900: "#5A0E0A",
                    },
                    black: "#111820",
                },
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
