import { React, useState } from "react";
import { useForm } from "@inertiajs/inertia-react";
import DatePicker from "react-datepicker";

import "react-datepicker/dist/react-datepicker.css";

const dateFormat = "yyyy-MM-dd";

export default function RequestVehicle({ availableVehicles, locations }) {
    const { data, setData, post, processing, errors } = useForm({
        vehicle: "",
        pickupLocation: "",
        deliverLocation: "",
        pickupDate: "",
    });

    const [vehicleError, setVehicleError] = useState("");
    const [pickupLocationError, setPickupLocationError] = useState("");
    const [deliverLocationError, setDeliverLocationError] = useState("");
    const [pickupDateError, setPickupDateError] = useState("");

    function handleSubmit(e) {
        e.preventDefault();

        if (validateForm()) {
            post(route("vehicle.store"));
        }
    }

    function validateForm() {
        const { vehicle, pickupLocation, deliverLocation, pickupDate } = data;

        resetErrors();

        if (vehicle == "") {
            setVehicleError("Required field");
            return false;
        }

        if (pickupLocation == "") {
            setPickupLocationError("Required field");
            return false;
        }

        if (deliverLocation == "") {
            setDeliverLocationError("Required field");
            return false;
        }

        if (pickupDate == "" || pickupDate === null) {
            setPickupDateError("Required field");
            return false;
        }

        return true;
    }

    function resetErrors() {
        setVehicleError("");
        setPickupLocationError("");
        setDeliverLocationError("");
        setPickupDateError("");
    }

    return (
        <>
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
                    <label htmlFor="vehicle">Select vehicle</label>

                    <select
                        id="vehicle"
                        name="vehicle"
                        value={data.vehicle}
                        onChange={(e) => setData("vehicle", e.target.value)}
                        className="form-control"
                    >
                        <option value="" disabled>
                            Select a vehicle
                        </option>
                        {availableVehicles &&
                            availableVehicles.map((vehicle, i) => (
                                <option
                                    value={vehicle.id}
                                    key={`vehicle-${i + 1}`}
                                >
                                    {vehicle.category.title}
                                </option>
                            ))}
                    </select>

                    {vehicleError && (
                        <div className="alert alert-danger">{vehicleError}</div>
                    )}
                </div>

                {/* Pickup location */}
                <div className="form-group mb-3">
                    <label htmlFor="pickupLocation">Pickup Location</label>

                    <select
                        id="pickupLocation"
                        name="pickupLocation"
                        value={data.pickupLocation}
                        onChange={(e) =>
                            setData("pickupLocation", e.target.value)
                        }
                        className="form-control"
                    >
                        <option value="" disabled>
                            Select pickup location
                        </option>

                        {locations &&
                            locations.map((location, i) => (
                                <option
                                    value={location.id}
                                    key={`location-${i + 1}`}
                                >
                                    {location.location_name}
                                </option>
                            ))}
                    </select>

                    {pickupLocationError && (
                        <div className="alert alert-danger">
                            {pickupLocationError}
                        </div>
                    )}
                </div>

                {/* Deliver location */}
                <div className="form-group mb-3">
                    <label htmlFor="deliverLocation">Deliver Location</label>

                    <select
                        id="deliverLocation"
                        name="deliverLocation"
                        value={data.deliverLocation}
                        onChange={(e) =>
                            setData("deliverLocation", e.target.value)
                        }
                        className="form-control"
                    >
                        <option value="" disabled>
                            Select deliver location
                        </option>

                        {locations &&
                            locations.map((location, i) => (
                                <option
                                    value={location.id}
                                    key={`location-${i + 1}`}
                                >
                                    {location.location_name}
                                </option>
                            ))}
                    </select>

                    {deliverLocationError && (
                        <div className="alert alert-danger">
                            {deliverLocationError}
                        </div>
                    )}
                </div>

                {/* Pickup date */}
                <div className="form-group mb-3">
                    <label htmlFor="pickupDate">Pickup Date</label>
                    <DatePicker
                        id="pickupDate"
                        name="pickupDate"
                        dateFormat={dateFormat}
                        selected={data.pickupDate}
                        onChange={(date) => setData("pickupDate", date)}
                        minDate={new Date()}
                        className="form-control"
                    />

                    {pickupDateError && (
                        <div className="alert alert-danger">
                            {pickupDateError}
                        </div>
                    )}
                </div>

                <div className="mt-4 d-flex justify-content-end">
                    <button
                        type="submit"
                        role="button"
                        disabled={processing}
                        className="btn btn-primary"
                    >
                        Make Request
                    </button>
                </div>
            </form>
        </>
    );
}
