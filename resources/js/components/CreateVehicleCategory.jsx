import React, { useRef, useEffect, useState } from "react";
import { useForm } from "@inertiajs/inertia-react";

export default function CreateVehicleCategory(props) {
    const {
        data,
        setData,
        post,
        processing,
        errors,
        reset,
        clearErrors,
        wasSuccessful,
    } = useForm({
        vehicleCategoryName: "",
    });

    const [showSuccess, setShowSuccess] = useState(false);
    const submitBtnRef = useRef();

    function handleSubmit(e) {
        e.preventDefault();
        post(route("vehicleCategory.store"));
    }

    useEffect(() => {
        if (props.formSubmitCount > 0) {
            submitBtnRef.current.click();
        }
    }, [props.formSubmitCount]);

    useEffect(() => {
        if (wasSuccessful) {
            setShowSuccess(true);
            setTimeout(() => {
                props.onSuccessFormSubmit();
                reset();
                clearErrors();
                setShowSuccess(false);
            }, 1000);
        }
    }, [wasSuccessful]);

    return (
        <>
            <form onSubmit={handleSubmit}>
                {showSuccess && (
                    <div className="alert alert-success">
                        Vehicle category created.
                    </div>
                )}

                {/* show validation error message */}
                {errors.message && (
                    <div className="alert alert-danger mb-2">
                        {errors.message}
                    </div>
                )}

                <div className="form-group mb-3">
                    <label htmlFor="vehicleCategoryName">Category Name</label>

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
                        ref={submitBtnRef}
                        type="submit"
                        role="button"
                        disabled={processing}
                        className="btn btn-primary invisible"
                        style={{ width: 0, height: 0 }}
                    >
                        Submit Vehicle Category
                    </button>
                </div>
            </form>
        </>
    );
}
