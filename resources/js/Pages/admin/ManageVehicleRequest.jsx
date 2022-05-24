import React from "react";

export default function ManageVehicleRequest() {
    return (
        <form>
            <form onSubmit={handleSubmit}>
                {showSuccess && (
                    <div className="alert alert-success">Vehicle created.</div>
                )}

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
                        onChange={(e) => setData("vehicleNo", e.target.value)}
                        className="form-control"
                    />

                    {errors.vehicleNo && (
                        <div className="alert alert-danger">
                            {errors.vehicleNo}
                        </div>
                    )}
                </div>

                <div className="form-group">
                    <label htmlFor="vehicleCategory">Category</label>

                    <select
                        name="vehicleCategory"
                        id="vehicleCategory"
                        value={data.vehicleCategory}
                        onChange={(e) =>
                            setData("vehicleCategory", e.target.value)
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
        </form>
    );
}
