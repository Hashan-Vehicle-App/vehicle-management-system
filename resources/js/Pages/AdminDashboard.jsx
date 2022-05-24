import { usePage } from "@inertiajs/inertia-react";
import { React } from "react";

// Layouts
import AdminLayout from "../Layouts/AdminLayout";

// components
import { AdminVehicleRequests } from "../components/AdminVehicleRequests";

export default function AdminDashboard() {
    const { vehicleRequests } = usePage().props;

    return (
        <>
            <AdminLayout title="Dashboard">
                <div className="page-section">
                    <div className="page-section-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Vehicle Requests</h5>
                        </div>
                    </div>
                    <div className="page-section-content">
                        <AdminVehicleRequests
                            vehicleRequests={vehicleRequests}
                        />
                    </div>
                </div>
            </AdminLayout>
        </>
    );
}
