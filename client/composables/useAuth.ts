import cookies from "js-cookie";

export default function () {
    const token = useState<string | null>("token", () => null);
    const user = useState<User | null>("user", () => {
        const item = localStorage.getItem("user");
        if (!item) return null;
        return JSON.parse(item);
    });

    const setToken = (tok: string, expiresIn: number, usr?: User) => {
        const expiryTime = new Date(new Date().getTime() + expiresIn * 1000);
        cookies.set("x-access-token", tok, { expires: expiryTime });
        token.value = tok;
        if (usr) {
            user.value = usr;
            localStorage.setItem("user", JSON.stringify(usr));
        }
    };

    const refreshToken = async () => {
        try {
            const { token, expiresIn } = await useApi<TokenResponse>(
                "/api/refresh-token",
                "post"
            );
            setToken(token, expiresIn);
        } catch (err) {
            logout();
            await navigateTo("/login");
        }
    };

    const logout = () => {
        cookies.remove("x-access-token");
        token.value = null;
        user.value = null;
        localStorage.removeItem("user");
    };

    return { user, token, setToken, refreshToken, logout };
}
