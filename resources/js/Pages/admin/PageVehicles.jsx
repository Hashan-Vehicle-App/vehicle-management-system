import { React, useState, useRef } from "react";
import { usePage } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

// components
import Vehicles from "../../components/Vehicles";
import CreateVehicle from "../../components/CreateVehicle";
import AddItemModal from "../../components/AddItemModal";

export default function PageVehicles() {
    const { vehicles } = usePage().props;

    return (
        <>
            <AdminLayout>
                <div className="page-section">
                    <div className="page-section-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Vehicles</h5>
                        </div>
                        <div>
                            <AddItemModal
                                addButtonText="Add Vehicle"
                                modalTitle="Create Vehicle"
                            >
                                <CreateVehicle />
                            </AddItemModal>
                        </div>
                    </div>
                    <div className="page-section-content">
                        <Vehicles vehicles={vehicles} />
                    </div>
                </div>
            </AdminLayout>
        </>
    );
}
