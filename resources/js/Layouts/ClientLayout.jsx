import { React } from "react";
import { Link, usePage } from "@inertiajs/inertia-react";

// components
import { AppLeftColumn } from "./components/AppLeftColumn";
import { AppRightColumn } from "./components/AppRightColumn";

// style
import "./AppLayout.scss";

export default function ClientLayout({ children, title }) {
    const { url } = usePage();

    return (
        <>
            <div className="app-layout">
                <AppLeftColumn>
                    <ClientMenuItems url={url} />
                </AppLeftColumn>

                <AppRightColumn title={title}>{children}</AppRightColumn>
            </div>
        </>
    );
}

function ClientMenuItems(props) {
    return (
        <>
            <div className="left-menu list-group list-group-flush">
                <Link
                    href={route("client.dashboard")}
                    className={`list-group-item list-group-item-action ${
                        props.url === "/client/dashboard" ? "active" : ""
                    }`}
                >
                    Dashboard
                </Link>
                <Link
                    href={route("client.vehicleRequest.show")}
                    className={`list-group-item list-group-item-action ${
                        props.url === "/client/request-vehicle" ? "active" : ""
                    }`}
                >
                    Request Vehicle
                </Link>
            </div>
        </>
    );
}
