import { React } from "react";
import { usePage } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

// components
import VehicleCategories from "../../components/VehicleCategories";
import CreateVehicleCategory from "../../components/CreateVehicleCategory";
import AddItemModal from "../../components/AddItemModal";

export default function PageVehicleCategories() {
    const { vehicleCategories } = usePage().props;

    return (
        <>
            <AdminLayout>
                <div className="page-section">
                    <div className="page-section-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Vehicle Categories</h5>
                        </div>
                        <div>
                            <AddItemModal
                                addButtonText="Add New"
                                modalTitle="Create Vehicle Category"
                            >
                                <CreateVehicleCategory />
                            </AddItemModal>
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
