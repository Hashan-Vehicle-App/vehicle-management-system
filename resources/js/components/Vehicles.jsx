import { React } from "react";
import { usePage, Link } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

export default function Vehicles({ vehicles }) {
    function deleteVehicle(id) {
        if (confirm("Are you sure you want to delete this vehicle?")) {
            Inertia.delete(route("vehicle.destroy", id));
        }
    }

    return (
        <>
            {vehicles.length ? (
                <>
                    <table className="table">
                        <tbody>
                            <tr className="table-light">
                                <th className="text-left">Vehicle No</th>
                                <th className="text-left">Category</th>
                                <th className="text-left">Status</th>
                                <th></th>
                                <th></th>
                            </tr>

                            {vehicles.map((vehicle, i) => (
                                <tr className="border-b" key={`vehicle-${i}`}>
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
                                                deleteVehicle(vehicle.id)
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
        </>
    );
}
