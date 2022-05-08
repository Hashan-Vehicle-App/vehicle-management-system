import { React } from "react";
import { Link } from "@inertiajs/inertia-react";

export default function Welcome() {
    return (
        <>
            <div className="d-flex justify-content-center align-items-center h-100">
                <Link
                    className="btn btn-primary me-3"
                    href={route("admin.login")}
                >
                    Admin Login
                </Link>

                <Link className="btn btn-success" href={route("client.login")}>
                    Client Login
                </Link>
            </div>
        </>
    );
}
