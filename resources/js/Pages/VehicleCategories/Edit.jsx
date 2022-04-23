// Vehicle category edit page

import { React, useEffect } from "react";
import { usePage, useForm } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

export default function EditVehicleCategory() {
    const { vehicleCategory } = usePage().props;

    const { data, setData, put, processing, errors } = useForm({
        vehicleCategoryName: vehicleCategory.title || "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        put(route("vehicleCategory.update", vehicleCategory.id));
    }

    return (
        <>
            <AdminLayout title="Create vehicle category">
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
                        <label htmlFor="vehicleCategoryName">
                            Category Name
                        </label>

                        <input
                            id="vehicleCategoryName"
                            name="vehicleCategoryName"
                            type="text"
                            placeholder="Enter a category name"
                            value={data.vehicleCategoryName}
                            onChange={(e) =>
                                setData("vehicleCategoryName", e.target.value)
                            }
                            className="form-control"
                        />

                        {errors.vehicleCategoryName && (
                            <div className="alert alert-danger">
                                {errors.vehicleCategoryName}
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
                            Update Vehicle Category
                        </button>
                    </div>
                </form>
            </AdminLayout>
        </>
    );
}
