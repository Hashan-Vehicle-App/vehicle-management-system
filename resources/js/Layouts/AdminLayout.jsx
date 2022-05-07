import { React } from "react";
import { Link } from "@inertiajs/inertia-react";

// style
import "./AppLayout.scss";

// components
import MainMenuItem from "../Shared/MainMenuItem";
import { getThemeProps } from "@mui/system";
import { AppRightColumn } from "./components/AppRightColumn";
import { AppLeftColumn } from "./components/AppLeftColumn";

export default function AdminLayout({ children, title }) {
    return (
        <>
            <div className="app-layout">
                <AppLeftColumn>
                    <AdminMenuItems />
                </AppLeftColumn>

                <AppRightColumn title={title}>{children}</AppRightColumn>
            </div>
        </>
    );
}

function AdminMenuItems() {
    return (
        <>
            <div className="left-menu list-group list-group-flush">
                <a
                    href={route("admin.dashboard")}
                    className="list-group-item list-group-item-action active"
                >
                    Dashboard
                </a>

                <a href={route("vehicle.index")} className="list-group-item">
                    Vehicles
                </a>
                <a
                    href={route("vehicleCategory.index")}
                    className="list-group-item"
                >
                    Vehicle Categories
                </a>
                <a href={route("location.index")} className="list-group-item">
                    Locations
                </a>
            </div>
        </>
    );
}
