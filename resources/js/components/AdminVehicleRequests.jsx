import React from "react";
import { Inertia } from "@inertiajs/inertia";

export function AdminVehicleRequests({ vehicleRequests }) {
    function handleStatusChangeClick(action, requestId) {
        Inertia.put(
            route("vehicleRequest.update", requestId),
            { status: action },
            { onSuccess: (page) => console.log(page) }
        );
    }

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
                                            className={`badge status-${
                                                request.status
                                            } ${
                                                request.status === "pending"
                                                    ? "cursor-pointer"
                                                    : ""
                                            }`}
                                            id={`vehicle-request-dropdown-${i}`}
                                            data-bs-toggle={
                                                request.status === "pending"
                                                    ? "dropdown"
                                                    : ""
                                            }
                                            aria-expanded="false"
                                        >
                                            {request.status}
                                        </span>

                                        {request.status === "pending" ? (
                                            <ul
                                                className="dropdown-menu"
                                                aria-labelledby={
                                                    request.status === "pending"
                                                        ? `vehicle-request-dropdown-${i}`
                                                        : ""
                                                }
                                            >
                                                <li>
                                                    <button
                                                        type="button"
                                                        className="dropdown-item"
                                                        onClick={() =>
                                                            handleStatusChangeClick(
                                                                "approved",
                                                                request.id
                                                            )
                                                        }
                                                    >
                                                        Approve
                                                    </button>
                                                </li>
                                                <li>
                                                    <button
                                                        type="button"
                                                        className="dropdown-item"
                                                        onClick={() =>
                                                            handleStatusChangeClick(
                                                                "declined",
                                                                request.id
                                                            )
                                                        }
                                                    >
                                                        Decline
                                                    </button>
                                                </li>
                                            </ul>
                                        ) : null}
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
