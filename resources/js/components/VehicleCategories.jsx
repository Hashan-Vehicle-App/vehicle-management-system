import { React } from "react";
import { usePage, Link } from "@inertiajs/inertia-react";

export default function VehicleCategories() {
    const { vehicleCategories } = usePage().props;

    return (
        <>
            {vehicleCategories.length > 0 ? (
                <>
                    <table className="table">
                        <tbody>
                            <tr className="table-light">
                                <th className="text-left">Category</th>
                                <th className="text-left">No. of Vehicles</th>
                                <th></th>
                                <th></th>
                            </tr>

                            {vehicleCategories.map((category, i) => (
                                <tr key={`vehicle-category-row-${i}`}>
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
                                            title="Edit vehicle category"
                                        >
                                            <i className="fa-solid fa-pen-to-square"></i>
                                        </Link>
                                    </td>
                                    <td className="text-center">
                                        <button
                                            type="button"
                                            className="btn text-danger cursor-pointer"
                                            onClick={() =>
                                                deleteCategory(category.id)
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
                <p>No vehicles categories</p>
            )}
        </>
    );
}
