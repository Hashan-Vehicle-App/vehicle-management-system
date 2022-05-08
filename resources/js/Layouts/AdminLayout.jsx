import { React } from "react";
import { Link, usePage } from "@inertiajs/inertia-react";

// style
import "./AppLayout.scss";

// components
import { AppRightColumn } from "./components/AppRightColumn";
import { AppLeftColumn } from "./components/AppLeftColumn";

export default function AdminLayout({ children, title }) {
    const { url } = usePage();

    return (
        <>
            <div className="app-layout">
                <AppLeftColumn>
                    <AdminMenuItems url={url} />
                </AppLeftColumn>

                <AppRightColumn title={title}>{children}</AppRightColumn>
            </div>
        </>
    );
}

function AdminMenuItems(props) {
    return (
        <>
            <div className="left-menu list-group list-group-flush">
                <Link
                    href={route("admin.dashboard")}
                    className={`list-group-item list-group-item-action ${
                        props.url === "/admin/dashboard" ? "active" : ""
                    }`}
                >
                    Dashboard
                </Link>

                <Link
                    href={route("admin.reports.show")}
                    className="list-group-item"
                >
                    Reports
                </Link>

                <Link
                    href={route("admin.vehicles.show")}
                    className={`list-group-item ${
                        props.url === "/admin/settings/vehicles" ? "active" : ""
                    }`}
                >
                    Vehicles
                </Link>
                <Link
                    href={route("admin.vehicleCategories.show")}
                    className={`list-group-item ${
                        props.url === "/admin/settings/vehicle-categories"
                            ? "active"
                            : ""
                    }`}
                >
                    Vehicle Categories
                </Link>
                <Link
                    href={route("admin.locations.show")}
                    className="list-group-item"
                >
                    Locations
                </Link>
            </div>
        </>
    );
}
