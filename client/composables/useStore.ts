import cookies from "js-cookie";

interface State {
    isSidebarMinimized: boolean;
    token: string | null;
}

export default {
    state: () => ({
        isSidebarMinimized: useState("isSidebarMinimized", () => false),
        token: useState("token", () => null),
    }),

    mutations: {
        TOGGLE_SIDEBAR(state: State) {
            state.isSidebarMinimized = !state.isSidebarMinimized;
        },

        SET_TOKEN(state: State, token: string) {
            state.token = token;
        },

        REMOVE_TOKEN(state: State) {
            state.token = null;
        },
    },

    actions: {
        setToken({ commit }, { token, expiresIn }) {
            this.$axios.setToken(token, "Bearer");
            const expiryTime = new Date(
                new Date().getTime() + expiresIn * 1000
            );
            cookies.set("x-access-token", token, { expires: expiryTime });
            commit("SET_TOKEN", token);
        },

        async refreshToken({ dispatch }) {
            const { token, expiresIn } = await this.$axios.$post(
                "refresh-token"
            );
            dispatch("setToken", { token, expiresIn });
        },

        logout({ commit }) {
            this.$axios.setToken(false);
            cookies.remove("x-access-token");
            commit("REMOVE_TOKEN");
        },
    },
};
