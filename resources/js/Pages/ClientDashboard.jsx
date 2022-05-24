import { usePage } from "@inertiajs/inertia-react";
import { React } from "react";

// Layouts
import ClientLayout from "../Layouts/ClientLayout";

// components
import { ClientVehicleRequests } from "../components/ClientVehicleRequests";

export default function ClientDashboard() {
    const { vehicleRequests } = usePage().props;

    return (
        <>
            <ClientLayout title="Dashboard">
                <div className="page-section">
                    <div className="page-section-header">
                        <div>
                            <h5>Vehicle Requests</h5>
                        </div>
                    </div>
                    <div className="page-section-content">
                        <ClientVehicleRequests
                            vehicleRequests={vehicleRequests}
                        />
                    </div>
                </div>
            </ClientLayout>
        </>
    );
}
