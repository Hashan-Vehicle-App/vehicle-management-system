// Location create page

import { React } from "react";
import { usePage, useForm } from "@inertiajs/inertia-react";
import AdminLayout from "../../Layouts/AdminLayout";

export default function CreateLocation() {
    const { data, setData, post, processing, errors } = useForm({
        locationName: "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        post(route("location.store"));
    }

    return (
        <>
            <AdminLayout title="Create Location">
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
                        <label htmlFor="location-name">Location Name</label>

                        <input
                            id="location-name"
                            name="locationName"
                            type="text"
                            value={data.locationName}
                            onChange={(e) =>
                                setData("locationName", e.target.value)
                            }
                            className="form-control"
                        />

                        {errors.locationName && (
                            <div className="alert alert-danger">
                                {errors.locationName}
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
                            Submit
                        </button>
                    </div>
                </form>
            </AdminLayout>
        </>
    );
}
