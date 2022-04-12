// Vehicle edit page

import { React } from "react";
import { usePage, useForm } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

export default function EditVehicle() {
    const { vehicle, vehicleCategories } = usePage().props;

    const { data, setData, put, processing, errors } = useForm({
        vehicleNo: vehicle.vehicle_no || "",
        vehicleCategory: vehicle.category_id || "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        put(route("vehicle.update", vehicle.id));
    }

    return (
        <>
            <AdminLayout title="Create vehicle">
                {vehicleCategories && (
                    <form
                        onSubmit={handleSubmit}
                        className="mb-5"
                        style={{ maxWidth: "400px" }}
                    >
                        {/* show validation error message */}
                        {errors.message && (
                            <div className="alert alert-danger mb-2">
                                {errors.message}
                            </div>
                        )}

                        <div className="form-group mb-3">
                            <label htmlFor="vehicleNo">Vehicle No</label>

                            <input
                                id="vehicleNo"
                                name="vehicleNo"
                                type="text"
                                placeholder="Enter a vehicle no"
                                value={data.vehicleNo}
                                onChange={(e) =>
                                    setData("vehicleNo", e.target.value)
                                }
                                className="form-control"
                            />

                            {errors.vehicleNo && (
                                <div className="alert alert-danger">
                                    {errors.vehicleNo}
                                </div>
                            )}
                        </div>

                        <div className="form-group mb-4">
                            <label htmlFor="vehicleCategory">Category</label>

                            <select
                                name="vehicleCategory"
                                id="vehicleCategory"
                                value={data.vehicleCategory}
                                onChange={(e) =>
                                    setData("vehicleCategory", e.target.value)
                                }
                                className="form-control"
                            >
                                <option value="" disabled>
                                    Select a vehicle category
                                </option>
                                {vehicleCategories.map((category, i) => (
                                    <option
                                        value={category.id}
                                        key={`vehicle-category-${i}`}
                                    >
                                        {category.title}
                                    </option>
                                ))}
                            </select>

                            {errors.vehicleCategory && (
                                <div className="alert alert-danger">
                                    {errors.vehicleCategory}
                                </div>
                            )}
                        </div>

                        <div>
                            <button
                                type="submit"
                                role="button"
                                disabled={processing}
                                className="btn btn-primary"
                            >
                                Update Vehicle
                            </button>
                        </div>
                    </form>
                )}
            </AdminLayout>
        </>
    );
}
