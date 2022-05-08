import React, { useState, useEffect } from "react";
import { CSVLink } from "react-csv";
import * as moment from "moment";

export default function ReportVehicleRequests({ vehicleRequests }) {
    const [data, setData] = useState([]);
    const [headers, setHeaders] = useState([]);
    const [reportVehicleRequests, setReportVehicleRequests] = useState([]);
    const [selectedReportStart, setSelectedReportStart] = useState("");
    const [selectedReportEnd, setSelectedReportEnd] = useState("");

    function handleReportPeriodChange(e) {
        console.log(e.target.value);

        const range = e.target.value;
        let startDate;
        let endDate;

        if (range === "last-month") {
            const dates = getLastMonthStartEndDates();
            startDate = dates.startDate;
            endDate = dates.endDate;
        } else if (range === "last-3-months") {
            const dates = getLast3MonthsStartEndDates();
            startDate = dates.startDate;
            endDate = dates.endDate;
        }

        const tempRequests = vehicleRequests.filter((request) => {
            const date = moment(request.pickup_date);

            if (!startDate || !endDate) {
                return true;
            }

            return (
                date.isSameOrAfter(startDate) && date.isSameOrBefore(endDate)
            );
        });

        setSelectedReportStart(startDate);
        setSelectedReportEnd(endDate);
        setReportVehicleRequests(tempRequests);
    }

    function getLastMonthStartEndDates() {
        const dateFormatString = "YYYY-MM-DD";

        let startDate;
        let endDate;

        let date = moment().subtract(1, "months");

        startDate = date.startOf("month").format(dateFormatString);
        endDate = date.endOf("month").format(dateFormatString);

        return {
            startDate,
            endDate,
        };
    }

    function getLast3MonthsStartEndDates() {
        const dateFormatString = "YYYY-MM-DD";

        let startDate;
        let endDate;

        let date = moment().subtract(3, "months");
        startDate = date.startOf("month").format(dateFormatString);

        date = moment().subtract(1, "months");
        endDate = date.endOf("month").format(dateFormatString);

        return {
            startDate,
            endDate,
        };
    }

    useEffect(() => {
        const headers = [
            { label: "Vehicle Type", key: "vehicle_category" },
            { label: "Vehicle Registration", key: "vehicle_no" },
            { label: "Pickup Location", key: "pickup_location" },
            { label: "Deliver Location", key: "deliver_location" },
            { label: "Date", key: "pickup_date" },
            { label: "Cost", key: "cost" },
        ];

        const data = reportVehicleRequests.map((request) => ({
            vehicle_category: request.vehicle.category.title,
            vehicle_no: request.vehicle.vehicle_no,
            pickup_location: request.pickup_location.name,
            deliver_location: request.deliver_location.name,
            pickup_date: request.pickup_date,
            cost: "Rs. " + request.cost,
        }));

        setData(data);
        setHeaders(headers);
    }, [reportVehicleRequests]);

    useEffect(() => {
        setReportVehicleRequests(vehicleRequests);
    }, [vehicleRequests]);

    return (
        <>
            <div className="mb-3 d-flex justify-content-end">
                <div className="me-3">
                    <div className="input-group">
                        <div className="input-group-text">Period</div>
                        <select
                            className="form-control"
                            onChange={handleReportPeriodChange}
                        >
                            <option value="">None</option>
                            <option value="last-month">Last Month</option>
                            <option value="last-3-months">Last 3 Months</option>
                        </select>
                    </div>
                </div>

                <CSVLink
                    className="btn btn-primary"
                    data={data}
                    headers={headers}
                    filename={`report-from-${selectedReportStart}-to-${selectedReportEnd}`}
                >
                    Download CSV
                </CSVLink>
            </div>

            {reportVehicleRequests && reportVehicleRequests.length ? (
                <>
                    <table className="table">
                        <tbody>
                            <tr className="table-light">
                                <th>Vehicle Type</th>
                                <th>Vehicle</th>
                                <th>Pickup Location</th>
                                <th>Deliver Location</th>
                                <th>Date</th>
                                <th>Cost</th>
                                <th>Status</th>
                            </tr>

                            {reportVehicleRequests.map((request, i) => (
                                <tr key={`request-row-${i}`}>
                                    <td>{request.vehicle.category.title}</td>
                                    <td>{request.vehicle.vehicle_no}</td>
                                    <td>{request.pickup_location.name}</td>
                                    <td>{request.deliver_location.name}</td>
                                    <td>{request.pickup_date}</td>
                                    <td>Rs. {request.cost}</td>
                                    <td>
                                        <span
                                            className={`badge status-${
                                                request.status
                                            } ${
                                                request.status === "pending"
                                                    ? "cursor-pointer"
                                                    : ""
                                            }`}
                                            id={`vehicle-request-dropdown-${i}`}
                                            data-bs-toggle={
                                                request.status === "pending"
                                                    ? "dropdown"
                                                    : ""
                                            }
                                            aria-expanded="false"
                                        >
                                            {request.status}
                                        </span>

                                        {request.status === "pending" ? (
                                            <ul
                                                className="dropdown-menu"
                                                aria-labelledby={
                                                    request.status === "pending"
                                                        ? `vehicle-request-dropdown-${i}`
                                                        : ""
                                                }
                                            >
                                                <li>
                                                    <button
                                                        type="button"
                                                        className="dropdown-item"
                                                        onClick={() =>
                                                            handleStatusChangeClick(
                                                                "approved",
                                                                request.id
                                                            )
                                                        }
                                                    >
                                                        Approve
                                                    </button>
                                                </li>
                                                <li>
                                                    <button
                                                        type="button"
                                                        className="dropdown-item"
                                                        onClick={() =>
                                                            handleStatusChangeClick(
                                                                "declined",
                                                                request.id
                                                            )
                                                        }
                                                    >
                                                        Decline
                                                    </button>
                                                </li>
                                            </ul>
                                        ) : null}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </>
            ) : (
                <p>No report data.</p>
            )}
        </>
    );
}
