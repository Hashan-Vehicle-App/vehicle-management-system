// Vehicle edit page

import { React, useEffect, useRef } from "react";
import { usePage, useForm, Link } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

export default function EditVehicle() {
    const { vehicle, vehicleCategories } = usePage().props;
    const vehicleIndexLinkref = useRef(null);

    const { data, setData, put, processing, errors, wasSuccessful } = useForm({
        vehicleNo: vehicle.vehicle_no || "",
        vehicleCategory: vehicle.category_id || "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        put(route("vehicle.update", vehicle.id));
    }

    useEffect(() => {
        if (wasSuccessful) {
            setTimeout(() => {
                if (vehicleIndexLinkref) {
                    vehicleIndexLinkref.current.click();
                }
            }, 1000);
        }
    }, [wasSuccessful]);

    return (
        <>
            <AdminLayout title="Create vehicle">
                {vehicleCategories && (
                    <>
                        {wasSuccessful && (
                            <>
                                <div className="alert alert-success">
                                    Vehicle updated.
                                </div>
                                <Link
                                    href={route("admin.vehicles.show")}
                                    style={{
                                        visibility: "hidden",
                                        width: 0,
                                        height: 0,
                                    }}
                                    ref={vehicleIndexLinkref}
                                >
                                    Vehicles
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
                                <label htmlFor="vehicleCategory">
                                    Category
                                </label>

                                <select
                                    name="vehicleCategory"
                                    id="vehicleCategory"
                                    value={data.vehicleCategory}
                                    onChange={(e) =>
                                        setData(
                                            "vehicleCategory",
                                            e.target.value
                                        )
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
                    </>
                )}
            </AdminLayout>
        </>
    );
}
