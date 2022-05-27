import { Link } from "@inertiajs/inertia-react";
import { React } from "react";

import "./AuthLayout.css";

export default function AuthLayout({ children, title }) {
    return (
        <main
            className="auth-wrapper d-flex align-items-center justify-content-center"
            style={{ height: "100%" }}
        >
            <div
                className="auth-container shadow-sm border rounded overflow-hidden bg-white"
                style={{ width: "400px" }}
            >
                <div className="auth-page-title pt-3">
                    <h4 className="text-center mb-0">{title}</h4>
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
