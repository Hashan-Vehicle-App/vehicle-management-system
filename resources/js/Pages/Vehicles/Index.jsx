// Vehicle index page

import { React } from "react";
import { usePage, Link } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

// Layouts
import AppLayout from "../../Layouts/AppLayout";

export default function Vehicles() {
    const { vehicles } = usePage().props;

    function deleteVehicle(id) {
        if (confirm("Are you sure you want to delete this vehicle?")) {
            Inertia.delete(route("vehicle.destroy", id));
        }
    }

    return (
        <AppLayout>
            <div className="bg-white overflow-hidden rounded shadow-sm">
                <div
                    className="px-3 pt-3 pb-2 d-flex justify-content-between align-items-center"
                    style={{ backgroundColor: "#f5f5f5" }}
                >
                    <div>
                        <h5>Vehicles</h5>
                    </div>
                    <div>
                        <Link
                            as="button"
                            href={route("vehicle.create")}
                            className="btn btn-primary"
                        >
                            Add Vehicle
                        </Link>
                    </div>
                </div>

                <div className="bg-white p-4">
                    {vehicles.length ? (
                        <>
                            <table className="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th className="text-left">
                                            Vehicle No
                                        </th>
                                        <th className="text-left">Category</th>
                                        <th className="text-left">Status</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {vehicles.map((vehicle, i) => (
                                        <tr
                                            className="border-b"
                                            key={`vehicle-${i}`}
                                        >
                                            <td>{vehicle.vehicle_no}</td>
                                            <td>{vehicle.category.title}</td>
                                            <td>
                                                <div className="badge bg-primary">
                                                    {vehicle.status}
                                                </div>
                                            </td>
                                            <td className="text-center">
                                                {/* Edit vehicle link */}
                                                <Link
                                                    as="button"
                                                    href={route(
                                                        "vehicle.edit",
                                                        vehicle.id
                                                    )}
                                                    className="btn text-accent cursor-pointer"
                                                >
                                                    <i className="fa-solid fa-pen-to-square"></i>
                                                </Link>
                                            </td>
                                            <td className="text-center">
                                                <button
                                                    type="button"
                                                    className="btn text-danger cursor-pointer"
                                                    onClick={() =>
                                                        deleteVehicle(
                                                            vehicle.id
                                                        )
                                                    }
                                                >
                                                    <i className="fa-solid fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </>
                    ) : (
                        <p>No vehicles.</p>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
