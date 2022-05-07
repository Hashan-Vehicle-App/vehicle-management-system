import { usePage } from "@inertiajs/inertia-react";
import { React } from "react";

// Layouts
import ClientLayout from "../../Layouts/ClientLayout";

// components
import RequestVehicle from "../../components/RequestVehicle";

export default function RequestVehiclePage() {
    const { availableVehiclesToday, locations } = usePage().props;

    return (
        <>
            <ClientLayout title="Request Vehicle">
                <div className="page-section">
                    <div className="page-section-header">
                        <div>
                            <h5>Request Vehicle</h5>
                        </div>
                    </div>
                    <div className="page-section-content">
                        <RequestVehicle
                            availableVehicles={availableVehiclesToday}
                            locations={locations}
                        />
                    </div>
                </div>
            </ClientLayout>
        </>
    );
}
