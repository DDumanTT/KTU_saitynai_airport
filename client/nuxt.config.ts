// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    ssr: false,
    modules: ["@vuestic/nuxt", "nuxt-typed-router", "nuxt-lodash"],

    runtimeConfig: {
        public: {
            apiUrl: "",
        },
    },

    vuestic: {
        config: {
            colors: {
                currentPresetName: "dark",
                presets: {
                    dark: {
                        primary: "#06d6a0",
                    },
                },
            },
        },
    },
});
