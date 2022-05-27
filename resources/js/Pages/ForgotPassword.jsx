import React from "react";

export default function ForgotPassword() {
    return (
        <div className="d-flex flex-column justify-content-center align-items-center h-100">
            <h1>Forgot Your Password?</h1>
            <p>
                Please contact system administrator.{" "}
                <a href="mailto:admin@tmsapp.com">admin@tmsapp.com</a>
            </p>
            <div className="mt-3">
                <a href="/">Back to Home</a>
            </div>
        </div>
    );
}
