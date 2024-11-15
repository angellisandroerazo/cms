import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require("daisyui")],

    daisyui: {
        themes: [
            {
                customLight: {
                    primary: "#2563eb",

                    secondary: "#1e3a8a",

                    accent: "#6b7d85",

                    neutral: "#1d2127",

                    "base-100": "#ffffff",

                    info: "#00b5ff",

                    success: "#00a96e",

                    warning: "#ffbe00",

                    error: "#ff5861",

                   "--rounded-box": "1rem", // border radius rounded-box utility class, used in card and other large boxes
                    "--rounded-btn": "0.25rem", // border radius rounded-btn utility class, used in buttons and similar element
                    "--rounded-badge": "0.25rem", // border radius rounded-badge utility class, used in badges and similar
                    "--animation-btn": "0.25s", // duration of animation when you click on button
                    "--animation-input": "0.2s", // duration of animation for inputs like checkbox, toggle, radio, etc
                    "--btn-focus-scale": "0.95", // scale transform of button when you focus on it
                    "--border-btn": "1px", // border width of buttons
                    "--tab-border": "1px", // border width of tabs
                    "--tab-radius": "0.5rem", // border radius of tabs
                },
                customDark: {
                    primary: "#3b82f6",

                    secondary: "#1e3a8a",

                    accent: "#6b7d85",

                    neutral: "#1d2127",

                    "base-100": "#202020",

                    info: "#00b5ff",

                    success: "#00a96e",

                    warning: "#ffbe00",

                    error: "#ff5861",

                    "--rounded-box": "1rem", // border radius rounded-box utility class, used in card and other large boxes
                    "--rounded-btn": "0.25rem", // border radius rounded-btn utility class, used in buttons and similar element
                    "--rounded-badge": "0.25rem", // border radius rounded-badge utility class, used in badges and similar
                    "--animation-btn": "0.25s", // duration of animation when you click on button
                    "--animation-input": "0.2s", // duration of animation for inputs like checkbox, toggle, radio, etc
                    "--btn-focus-scale": "0.95", // scale transform of button when you focus on it
                    "--border-btn": "1px", // border width of buttons
                    "--tab-border": "1px", // border width of tabs
                    "--tab-radius": "0.5rem", // border radius of tabs
                },
            },
        ],
    },
};
