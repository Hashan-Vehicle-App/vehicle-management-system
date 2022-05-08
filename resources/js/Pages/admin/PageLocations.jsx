import { React, useState, useRef } from "react";
import { usePage } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";
import Locations from "../../components/Locations";
import CreateLocation from "../../components/CreateLocation";
import AddItemModal from "../../components/AddItemModal";

export default function LocationsPage() {
    const { locations, success } = usePage().props;

    return (
        <AdminLayout title="Locations">
            {success && (
                <div className="mb-3 alert alert-success">{success}</div>
            )}

            <div className="page-section">
                <div className="page-section-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Locations</h5>
                    </div>
                    <div>
                        <AddItemModal
                            addButtonText="Add Location"
                            modalTitle="Create Location"
                        >
                            <CreateLocation />
                        </AddItemModal>
                    </div>
                </div>
                <div className="page-section-content">
                    <Locations locations={locations} />
                </div>
            </div>
        </AdminLayout>
    );
}
