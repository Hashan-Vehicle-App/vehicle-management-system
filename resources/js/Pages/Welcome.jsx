import { React } from "react";
import { Link } from "@inertiajs/inertia-react";

export default function Welcome() {
    return (
        <>
            <Link href="/admin/login">Admin Login</Link>
            <br />
            <Link href="/client/login">Client Login</Link>
        </>
    );
}
