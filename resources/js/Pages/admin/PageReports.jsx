import { React } from "react";
import { usePage } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

// components
import ReportVehicleRequests from "../../components/ReportVehicleRequests";

export default function PageReports() {
    const { vehicleRequests } = usePage().props;

    return (
        <>
            <AdminLayout>
                <div className="page-section">
                    <div className="page-section-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Reports</h5>
                        </div>
                        <div></div>
                    </div>
                    <div className="page-section-content">
                        <ReportVehicleRequests
                            vehicleRequests={vehicleRequests}
                        />
                    </div>
                </div>
            </AdminLayout>
        </>
    );
}
