enum Role {
    User = "user",
    Admin = "admin",
}

interface SelectOptions {
    text: string;
    value: number | string;
    key: number;
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

interface User extends ApiResponse {
    name: string;
    email: string;
    role: Role;
}

interface City extends ApiResponse {
    country: string;
    name: string;
}

interface Airport extends ApiResponse {
    name: string;
    address: string;
    code: string;
    city_id: number;
    city?: City;
}

interface Airline extends ApiResponse {
    name: string;
    hq_address: string;
    logo: string;
}

interface Flight extends ApiResponse {
    code: string;
    gate: string;
    duration: Date;
    departure_time: Date;
    arrival_time: Date;
    price: number;
    departure_id: number;
    departure?: Airport;
    arrival_id: number;
    arrival?: Airport;
    airline_id: number;
    airline?: Airline;
}

interface Plane extends ApiResponse {
    model: string;
    seats: string;
    airline_id: number;
    airline?: Airline;
}
