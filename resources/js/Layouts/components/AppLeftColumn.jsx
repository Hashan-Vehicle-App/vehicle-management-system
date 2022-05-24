import React from "react";

export function AppLeftColumn({ children }) {
    return (
        <div id="app-left-column">
            <div className="inner-container">
                <div className="app-title">TMS APP</div>

                <nav className="app-nav">{children}</nav>
            </div>
        </div>
    );
}
