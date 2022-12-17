import { FetchOptions } from "ofetch";

export default function <T>(
    endpoint: string,
    method: string,
    body?: RequestInit["body"] | Record<string, any>,
    options?: Partial<FetchOptions>
) {
    const runtimeConfig = useRuntimeConfig();

    return $fetch<T>(endpoint, {
        onResponseError({ response }) {
            throw new Error(response._data.message);
        },
        baseURL: runtimeConfig.public.apiUrl,
        credentials: "include",
        method,
        body,
        ...options,
    });
}
