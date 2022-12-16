import { FetchOptions } from "ofetch";

export default function <T>(
    endpoint: string,
    method: string,
    body?: RequestInit["body"] | Record<string, any>,
    options?: Partial<FetchOptions>
) {
    return $fetch<T>(endpoint, {
        onResponseError({ response }) {
            throw new Error(response._data.message);
        },
        baseURL: "http://localhost",
        credentials: "include",
        method,
        body,
        ...options,
    });
}
