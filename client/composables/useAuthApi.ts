import { FetchOptions } from "ofetch";

export default function <T>(
    endpoint: string,
    method: string,
    body?: RequestInit["body"] | Record<string, any>,
    options?: Partial<FetchOptions>
) {
    const { token, refreshToken } = useAuth();
    return $fetch<T>(endpoint, {
        onResponseError({ response }) {
            throw new Error(response._data.message);
        },
        async onRequest({ options }) {
            if (!token.value) await refreshToken();
            options.headers = { Authorization: `Bearer ${token.value}` };
        },
        baseURL: "http://localhost",
        credentials: "include",
        method,
        body,
        ...options,
    });
}
