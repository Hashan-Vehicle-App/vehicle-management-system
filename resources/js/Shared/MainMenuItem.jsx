import { React } from "react";
import { Link } from "@inertiajs/inertia-react";

import "./MainMenuItem.scss";

export default function MainMenuItem({ link, text }) {
    return (
        <div className="mb-4">
            <Link href={route(link)} className="main-menu-item">
                <div>{text}</div>
            </Link>
        </div>
    );
}
