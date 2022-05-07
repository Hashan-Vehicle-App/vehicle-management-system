import React from "react";
import { Link } from "@inertiajs/inertia-react";

export function AppRightColumn({ children, title }) {
    return (
        <div id="app-right-column" className="w-100">
            <header id="app-header" className="d-flex justify-content-between">
                <div className="page-title">{title}</div>

                <div className="header-nav">
                    <ul className="list-unstyled">
                        <li>
                            <Link
                                as="button"
                                href={route("logout")}
                                method="post"
                                className="btn btn-default"
                            >
                                Logout
                            </Link>
                        </li>
                    </ul>
                </div>
            </header>

            <main className="page-content">{children}</main>
        </div>
    );
}
