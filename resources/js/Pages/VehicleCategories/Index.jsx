// Vehicle categories index page

import { React } from "react";
import { usePage, Link } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

export default function VehicleCategories() {
    const { vehicleCategories } = usePage().props;

    function deleteCategory(id) {
        if (confirm("Are you sure you want to delete this category?")) {
            Inertia.delete(route("vehicleCategory.destroy", id));
        }
    }

    return (
        <>
            <AdminLayout>
                <div className="bg-white overflow-hidden rounded shadow-sm">
                    <div
                        className="px-3 pt-3 pb-2 d-flex justify-content-between align-items-center"
                        style={{ backgroundColor: "#f5f5f5" }}
                    >
                        <div>
                            <h5>Vehicle Categories</h5>
                        </div>
                        <div>
                            <Link
                                as="button"
                                href={route("vehicleCategory.create")}
                                className="btn btn-primary"
                            >
                                Add New
                            </Link>
                        </div>
                    </div>

                    <div className="bg-white p-4">
                        {vehicleCategories.length > 0 ? (
                            <>
                                <table className="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th className="text-left">
                                                Category
                                            </th>
                                            <th className="text-left">
                                                No. of Vehicles
                                            </th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {vehicleCategories.map(
                                            (category, i) => (
                                                <tr
                                                    className="border-b"
                                                    key={`category-${i}`}
                                                >
                                                    <td>{category.title}</td>
                                                    <td>1</td>
                                                    <td className="text-center">
                                                        {/* Edit category link */}
                                                        <Link
                                                            as="button"
                                                            href={route(
                                                                "vehicleCategory.edit",
                                                                category.id
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
                                                                deleteCategory(
                                                                    category.id
                                                                )
                                                            }
                                                        >
                                                            <i className="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            )
                                        )}
                                    </tbody>
                                </table>
                            </>
                        ) : (
                            <p>No vehicles categories</p>
                        )}
                    </div>
                </div>
            </AdminLayout>
        </>
    );
}
