import { React } from "react";
import { Link } from "@inertiajs/inertia-react";

// style
import "./AppLayout.scss";

// components
import MainMenuItem from "../Shared/MainMenuItem";

export default function AdminLayout({ children, title }) {
    return (
        <>
            <div className="app-layout">
                <div id="app-left-column">
                    <div className="inner-container">
                        <div className="app-title">VMS APP</div>

                        <nav className="app-nav">
                            <AdminMenuItems />
                        </nav>
                    </div>
                </div>

                <div id="app-right-column" className="w-100">
                    <header
                        id="app-header"
                        className="d-flex justify-content-between"
                    >
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
            </div>
        </>
    );
}

function AdminMenuItems() {
    return (
        <>
            <MainMenuItem link="client.dashboard" text="Dashboard" />

            <MainMenuItem link="vehicle.index" text="Vehicles" />

            <MainMenuItem
                link="vehicleCategory.index"
                text="Vehicle Categories"
            />

            <MainMenuItem link="location.index" text="Locations" />
        </>
    );
}

function ClientMenuItems() {
    return (
        <>
            <MainMenuItem link="client.dashboard" text="Dashboard" />
        </>
    );
}
