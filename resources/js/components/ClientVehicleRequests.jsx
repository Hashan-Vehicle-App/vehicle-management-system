import React from "react";

export function ClientVehicleRequests({ vehicleRequests }) {
    return (
        <>
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
                                <th>Cost</th>
                                <th>Status</th>
                            </tr>

                            {vehicleRequests.map((request, i) => (
                                <tr key={`request-row-${i}`}>
                                    <td>{request.vehicle.category.title}</td>
                                    <td>{request.vehicle.vehicle_no}</td>
                                    <td>{request.pickup_location.name}</td>
                                    <td>{request.deliver_location.name}</td>
                                    <td>{request.pickup_date}</td>
                                    <td>Rs. {request.cost}</td>
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
        </>
    );
}
