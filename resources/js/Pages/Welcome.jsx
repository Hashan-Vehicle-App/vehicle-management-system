import { React } from "react";
import { Link } from "@inertiajs/inertia-react";

export default function Welcome() {
    return (
        <>
            <Link href={route("admin.login")}>Admin Login</Link>
            <br />
            <Link href={route("client.login")}>Client Login</Link>
        </>
    );
}
