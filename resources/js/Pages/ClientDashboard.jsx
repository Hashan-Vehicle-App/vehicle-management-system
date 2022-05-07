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
                            <h5>Request Vehicle</h5>
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

function AvailableVehiclesToday({ availableVehiclesToday }) {
    return (
        <>
            <table className="table">
                <tbody>
                    <tr className="table-light">
                        <th>Registration</th>
                        <th>Type</th>
                    </tr>

                    {availableVehiclesToday.map((vehicle, index) => (
                        <tr key={`available-vehicle-row-${index}`}>
                            <td>{vehicle.vehicle_no}</td>
                            <td>{vehicle.category.title}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </>
    );
}
