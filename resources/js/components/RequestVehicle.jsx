import { React, useState } from "react";
import { useForm } from "@inertiajs/inertia-react";
import DatePicker from "react-datepicker";
import { Inertia } from "@inertiajs/inertia";

import "react-datepicker/dist/react-datepicker.css";
import axios from "axios";
import * as moment from "moment";

const dateFormat = "yyyy-MM-dd";

export default function RequestVehicle({ locations }) {
    const {
        data,
        setData,
        post,
        processing,
        errors,
        transform,
        wasSuccessful,
    } = useForm({
        vehicle: "",
        pickupLocation: "",
        deliverLocation: "",
        pickupDate: "",
    });

    const [availableVehicles, setAvailableVehicles] = useState(null);
    const [vehicleCategoriesWithCount, setVehicleCategoriesWithCount] =
        useState(null);
    const [selectedVehicle, setSelectedVehicle] = useState(null);

    function handleSubmit(e) {
        e.preventDefault();

        transform((data) => ({
            ...data,
            pickupDate: moment(data.pickupDate).format("YYYY-MM-DD"),
        }));

        console.log(data);

        post(route("vehicleRequest.store"), {
            onSubmit: (page) => console.log("submit page: ", page),
            onSuccess: (page) => {
                setTimeout(() => {
                    Inertia.get(route("client.dashboard"));
                }, 1000);
            },
        });
    }

    async function handleDateChange(date) {
        setData("pickupDate", date);

        const vehicleCategoryList = await getVehicleCategoryList(
            moment(date).format("YYYY-MM-DD")
        );
        setVehicleCategoriesWithCount(vehicleCategoryList);
    }

    function fetchAvailableVehiclesByDate(date) {
        return new Promise((resolve, reject) => {
            axios
                .get(route("get-available-vehicles-by-date"), {
                    params: { date },
                })
                .then((res) => {
                    resolve(res.data);
                })
                .catch((err) => {
                    console.log("error fetching available vehicles by date."),
                        reject(err.error);
                });
        });
    }

    function fetchAllVehicleCategories() {
        return new Promise((resolve, reject) => {
            axios
                .get(route("vehicleCategory.index"))
                .then((res) => {
                    console.log("types: ", res.data);
                    resolve(res.data);
                })
                .catch((err) => {
                    console.log("error fetching vehicle categories");
                    reject(err.error);
                });
        });
    }

    async function getVehicleCategoryList(date) {
        const availableVehicles = await fetchAvailableVehiclesByDate(date);

        setAvailableVehicles(availableVehicles);

        const vehicleCategories = await fetchAllVehicleCategories();
        availableVehicles.forEach((vehicle) => {
            vehicleCategories.filter(
                (category) => category.id === vehicle.category_id
            );
        });

        const tempVehicleCategories = [];

        vehicleCategories.forEach((category) => {
            const vehiclesOfThisCategory = availableVehicles.filter(
                (vehicle) => vehicle.category_id === category.id
            );

            const vehicleCategoryItem = {
                category_id: category.id,
                title: category.title,
                vehicle_count: vehiclesOfThisCategory.length,
            };

            tempVehicleCategories.push(vehicleCategoryItem);
        });

        return tempVehicleCategories;
    }

    function handleClickVehicleCategory(index) {
        const availableFirstVehicle =
            getAvailableFirstVehicleByCategoryIndex(index);

        if (availableFirstVehicle) {
            setData("vehicle", availableFirstVehicle.id);
            setSelectedVehicle(availableFirstVehicle);
        }
    }

    function getAvailableFirstVehicleByCategoryIndex(index) {
        const selectedVehicleCategoryId =
            vehicleCategoriesWithCount[index].category_id;
        return availableVehicles.find(
            (vehicle) => vehicle.category_id === selectedVehicleCategoryId
        );
    }

    return (
        <>
            {wasSuccessful && (
                <div className="alert alert-success">
                    Vehicle request submitted.
                </div>
            )}
            <form onSubmit={handleSubmit}>
                {/* show validation error message */}
                {errors.message && (
                    <div className="alert alert-danger mb-2">
                        {errors.message}
                    </div>
                )}

                <div className="row">
                    <div className="col-md-6">
                        {/* Pickup date */}
                        <div className="form-group mb-3">
                            <label htmlFor="pickupDate">Pickup Date</label>
                            <DatePicker
                                id="pickupDate"
                                name="pickupDate"
                                dateFormat={dateFormat}
                                selected={data.pickupDate}
                                onChange={handleDateChange}
                                minDate={new Date()}
                                className="form-control"
                            />

                            {errors.pickupDate && (
                                <div className="alert alert-danger">
                                    {errors.pickupDate}
                                </div>
                            )}
                        </div>

                        {/* Pickup location */}
                        <div className="form-group mb-3">
                            <label htmlFor="pickupLocation">
                                Pickup Location
                            </label>

                            <select
                                id="pickupLocation"
                                value={data.pickupLocation}
                                onChange={(e) =>
                                    setData("pickupLocation", e.target.value)
                                }
                                className="form-control"
                            >
                                <option value="" disabled></option>

                                {locations &&
                                    locations.map((location, i) => (
                                        <option
                                            value={location.id}
                                            key={`location-${i + 1}`}
                                        >
                                            {location.name}
                                        </option>
                                    ))}
                            </select>

                            {errors.pickupLocation && (
                                <div className="alert alert-danger">
                                    {errors.pickupLocation}
                                </div>
                            )}
                        </div>

                        {/* Deliver location */}
                        <div className="form-group mb-3">
                            <label htmlFor="deliverLocation">
                                Deliver Location
                            </label>

                            <select
                                id="deliverLocation"
                                name="deliverLocation"
                                value={data.deliverLocation}
                                onChange={(e) =>
                                    setData("deliverLocation", e.target.value)
                                }
                                className="form-control"
                            >
                                <option value="" disabled></option>

                                {locations &&
                                    locations.map((location, i) => (
                                        <option
                                            value={location.id}
                                            key={`location-${i + 1}`}
                                        >
                                            {location.name}
                                        </option>
                                    ))}
                            </select>

                            {errors.deliverLocation && (
                                <div className="alert alert-danger">
                                    {errors.deliverLocation}
                                </div>
                            )}
                        </div>
                    </div>

                    <div className="col-md-6">
                        <div className="inner-page-section h-100">
                            <div className="inner-page-section-content">
                                <p>
                                    {vehicleCategoriesWithCount ? (
                                        <span>
                                            Available Vehicles at{" "}
                                            {moment(data.pickupDate).format(
                                                "YYYY-MM-DD"
                                            )}
                                        </span>
                                    ) : (
                                        <span>
                                            No available vehicles. Please select
                                            another date
                                        </span>
                                    )}
                                </p>

                                {selectedVehicle && (
                                    <div>
                                        Selected Vehicle No:{" "}
                                        {selectedVehicle.vehicle_no}
                                    </div>
                                )}

                                <ul className="list-group">
                                    {vehicleCategoriesWithCount &&
                                        vehicleCategoriesWithCount.map(
                                            (vehicleCategory, index) => (
                                                <li
                                                    key={`vehicle-type-item=${index}`}
                                                    className={`list-group-item list-group-item-action d-flex justify-content-between cursor-pointer ${
                                                        vehicleCategory.category_id ===
                                                        selectedVehicle?.category_id
                                                            ? "active"
                                                            : ""
                                                    }`}
                                                    onClick={() =>
                                                        handleClickVehicleCategory(
                                                            index
                                                        )
                                                    }
                                                >
                                                    <div>
                                                        {vehicleCategory.title}
                                                    </div>
                                                    <span className="badge bg-primary rounded-pill">
                                                        {
                                                            vehicleCategory.vehicle_count
                                                        }
                                                    </span>
                                                </li>
                                            )
                                        )}
                                </ul>

                                {errors.vehicle && (
                                    <div className="alert alert-danger">
                                        {errors.vehicle}
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="mt-4">
                        <button
                            type="submit"
                            role="button"
                            disabled={processing || wasSuccessful}
                            className="btn btn-primary"
                        >
                            Make Request
                        </button>
                    </div>
                </div>
            </form>
        </>
    );
}
