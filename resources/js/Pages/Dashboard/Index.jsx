import { usePage } from "@inertiajs/inertia-react";
import { React } from "react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";
import ClientLayout from "../../Layouts/ClientLayout";

// components
import RequestVehicle from "../../components/RequestVehicle";

export default function Dashboard() {
    const { userRole, availableVehicles, locations } = usePage().props;

    return (
        <>
            {userRole === "admin" ? (
                <AdminLayout title="Dashboard">
                    <AdminContent />
                </AdminLayout>
            ) : userRole === "client" ? (
                <ClientLayout title="Dashboard">
                    <RequestVehicle
                        availableVehicles={availableVehicles}
                        locations={locations}
                    />
                </ClientLayout>
            ) : (
                <>No Content</>
            )}
        </>
    );
}

function AdminContent() {
    return <p>Admin content</p>;
}
