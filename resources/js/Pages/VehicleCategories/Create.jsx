// Vehicle create page

import { React } from "react";
import { useForm } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

export default function CreateVehicle() {
    const { data, setData, post, processing, errors } = useForm({
        vehicleCategoryName: "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        post(route("vehicleCategory.store"));
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
                            value={data.vehicleNo}
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
                            Create Vehicle Category
                        </button>
                    </div>
                </form>
            </AdminLayout>
        </>
    );
}
