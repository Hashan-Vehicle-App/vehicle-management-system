import { React } from "react";
import { usePage } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";
import VehicleCategories from "../../components/VehicleCategories";

export default function PageVehicleCategories() {
    const { vehicleCategories } = usePage().props;

    return (
        <>
            <AdminLayout>
                <div className="page-section">
                    <div className="page-section-header">
                        <div>
                            <h5>Vehicle Categories</h5>
                        </div>
                    </div>
                    <div className="page-section-content">
                        <VehicleCategories
                            vehicleCategories={vehicleCategories}
                        />
                    </div>
                </div>
            </AdminLayout>
        </>
    );
}
