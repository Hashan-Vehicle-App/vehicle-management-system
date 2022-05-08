import { React, useRef, useState, useEffect } from "react";
import { useForm } from "@inertiajs/inertia-react";

export default function CreateLocation(props) {
    const {
        data,
        setData,
        post,
        processing,
        errors,
        wasSuccessful,
        reset,
        clearErrors,
    } = useForm({
        locationName: "",
    });

    const [showSuccess, setShowSuccess] = useState(false);

    const submitBtnRef = useRef();

    function handleSubmit(e) {
        e.preventDefault();
        post(route("location.store"));
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
                    <div className="alert alert-success">Location created.</div>
                )}

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
                        ref={submitBtnRef}
                        type="submit"
                        role="button"
                        disabled={processing}
                        className="btn btn-primary invisible"
                        style={{ width: 0, height: 0 }}
                    >
                        Submit Vehicle
                    </button>
                </div>
            </form>
        </>
    );
}
