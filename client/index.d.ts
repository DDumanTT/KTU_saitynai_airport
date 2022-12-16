enum Role {
    User = "user",
    Admin = "admin",
}

interface User {
    name: string;
    email: string;
    role: Role;
}

interface TokenResponse {
    message: string;
    token: string;
    expiresIn: number;
    user: User;
}

interface ResponseError {
    data: { message: string };
}

interface TableAddItem {
    key: string;
    value: string;
    editable: boolean;
}

interface ApiResponse {
    id: number;
    created_at: Date;
    updated_at: Date;
}

interface City extends ApiResponse {
    country: string;
    name: string;
}
