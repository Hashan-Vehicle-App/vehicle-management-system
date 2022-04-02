import { Link } from "@inertiajs/inertia-react";
import { React } from "react";

export default function AuthLayout({ children, title }) {
    return (
        <main
            className="d-flex align-items-center justify-content-center"
            style={{ height: "100%" }}
        >
            <div
                className="auth-container rounded overflow-hidden bg-white"
                style={{ width: "480px" }}
            >
                <div className="auth-page-title px-4 py-3 bg-primary">
                    <h4 className="text-white text-center mb-0">{title}</h4>
                </div>
                <div className="auth-page-content p-4">{children}</div>
            </div>

            <Link
                href="/"
                className="position-fixed"
                style={{ bottom: "20px" }}
            >
                Go to Home
            </Link>
        </main>
    );
}
