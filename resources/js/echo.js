import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: "local",
    wsHost: "localhost",
    wsPort: 8080,
    forceTLS: false,
    authEndpoint: "http://localhost:8001/broadcasting/auth",
    withCredentials: true,
    auth: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            Accept: "application/json",
        },
    },
    enabledTransports: ["ws"],
});
