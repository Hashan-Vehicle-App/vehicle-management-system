import { React } from "react";
import AuthLayout from "../Layouts/AuthLayout";

export default function LoginPage() {
    return (
        <AuthLayout title="Login">
            <form method="post" action="/admin/login" className="login-form">
                <div className="form-group mb-3">
                    <label htmlFor="username">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        value=""
                        className="form-control"
                    />
                </div>

                <div className="form-group mb-4">
                    <label htmlFor="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        value=""
                        className="form-control"
                    />
                </div>

                <div className="d-flex justify-content-center">
                    <button
                        type="submit"
                        role="button"
                        className="btn btn-accent"
                    >
                        Login
                    </button>
                </div>
            </form>
        </AuthLayout>
    );
}
