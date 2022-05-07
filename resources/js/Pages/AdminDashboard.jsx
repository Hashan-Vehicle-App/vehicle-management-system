import { usePage } from "@inertiajs/inertia-react";
import { React } from "react";

// Layouts
import AdminLayout from "../Layouts/AdminLayout";

// components

export default function AdminDashboard() {
    const { vehicleRequests } = usePage().props;
    console.log("vehicle requests: ", vehicleRequests);
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
                        {vehicleRequests.length ? (
                            <>
                                <table className="table">
                                    <tbody>
                                        <tr className="table-light">
                                            <th>Vehicle Type</th>
                                            <th>Vehicle</th>
                                            <th>Pickup Location</th>
                                            <th>Deliver Location</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>

                                        {vehicleRequests.map((request, i) => (
                                            <tr key={`request-row-${i}`}>
                                                <td>
                                                    {
                                                        request.vehicle.category
                                                            .title
                                                    }
                                                </td>
                                                <td>
                                                    {request.vehicle.vehicle_no}
                                                </td>
                                                <td>
                                                    {
                                                        request.pickup_location
                                                            .name
                                                    }
                                                </td>
                                                <td>
                                                    {
                                                        request.deliver_location
                                                            .name
                                                    }
                                                </td>
                                                <td>{request.pickup_date}</td>
                                                <td>
                                                    <span
                                                        className={`badge status-${request.status}`}
                                                    >
                                                        {request.status}
                                                    </span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </>
                        ) : (
                            <p>No vehicle requests.</p>
                        )}
                    </div>
                </div>
            </AdminLayout>
        </>
    );
}
