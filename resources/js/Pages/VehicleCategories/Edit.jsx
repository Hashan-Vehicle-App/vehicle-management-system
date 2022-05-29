// Vehicle category edit page

import { React, useEffect, useRef } from "react";
import { usePage, useForm, Link } from "@inertiajs/inertia-react";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

export default function EditVehicleCategory() {
    const { vehicleCategory } = usePage().props;
    const vehicleCategoryIndexLinkref = useRef(null);

    const { data, setData, put, processing, errors, wasSuccessful } = useForm({
        vehicleCategoryName: vehicleCategory.title || "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        put(route("vehicleCategory.update", vehicleCategory.id));
    }

    useEffect(() => {
        if (wasSuccessful) {
            setTimeout(() => {
                if (vehicleCategoryIndexLinkref) {
                    vehicleCategoryIndexLinkref.current.click();
                }
            }, 1000);
        }
    }, [wasSuccessful]);

    return (
        <>
            <AdminLayout title="Create vehicle category">
                <>
                    {wasSuccessful && (
                        <>
                            <div className="alert alert-success">
                                Vehicle category updated.
                            </div>
                            <Link
                                href={route("admin.vehicleCategories.show")}
                                style={{
                                    visibility: "hidden",
                                    width: 0,
                                    height: 0,
                                }}
                                ref={vehicleCategoryIndexLinkref}
                            >
                                Vehicle Categories
                            </Link>
                        </>
                    )}
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
                                    setData(
                                        "vehicleCategoryName",
                                        e.target.value
                                    )
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
                </>
            </AdminLayout>
        </>
    );
}
