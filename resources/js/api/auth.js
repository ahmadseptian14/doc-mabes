import axios from "axios";

export async function login(credentials) {
    await axios.get("/sanctum/csrf-cookie");
    return axios.post("/api/login", credentials);
}

export async function logout() {
    return axios.post("/api/logout");
}

export async function getUser() {
    return axios.get("/api/user");
}
