import { FetchOptions } from "ofetch";

export default function <T>(
    endpoint: string,
    method: string,
    body?: RequestInit["body"] | Record<string, any>,
    options?: Partial<FetchOptions>
) {
    const { user, token, refreshToken } = useAuth();
    return $fetch<T>(endpoint, {
        onResponseError({ response }) {
            throw new Error(response._data.message);
        },
        async onRequest({ options }) {
            if (!user.value) await navigateTo("/login");
            if (!token.value) await refreshToken();
            // console.log(token.value);
            options.headers = { Authorization: `Bearer ${token.value}` };
        },
        baseURL: "http://localhost",
        credentials: "include",
        method,
        body,
        ...options,
    });
}
