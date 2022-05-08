import { React } from "react";
import { useForm } from "@inertiajs/inertia-react";

// Layouts
import AuthLayout from "../../Layouts/AuthLayout";

export default function AdminLoginPage() {
    const { data, setData, post, processing, errors } = useForm({
        username: "",
        password: "",
        remember: false,
    });

    function handleSubmit(e) {
        e.preventDefault();
        post(route("admin.login.attempt"));
    }

    return (
        <AuthLayout title="Admin Login">
            <form onSubmit={handleSubmit} className="login-form">
                {/* show validation error message */}
                {errors.message && (
                    <div className="alert alert-danger mb-2">
                        {errors.message}
                    </div>
                )}

                <div className="form-group mb-4">
                    <label htmlFor="username">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        value={data.username}
                        className="form-control"
                        onChange={(e) => setData("username", e.target.value)}
                    />
                    {errors.username && (
                        <div className="alert alert-danger">
                            {errors.username}
                        </div>
                    )}
                </div>

                <div className="form-group mb-4">
                    <label htmlFor="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        value={data.password}
                        className="form-control"
                        onChange={(e) => setData("password", e.target.value)}
                    />
                    {errors.password && (
                        <div className="alert alert-danger">
                            {errors.password}
                        </div>
                    )}
                </div>

                <button
                    type="submit"
                    role="button"
                    className="btn btn-primary w-100"
                    disabled={processing}
                >
                    Login
                </button>
            </form>
        </AuthLayout>
    );
}
