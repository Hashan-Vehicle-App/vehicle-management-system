import { React } from "react";
import { usePage, Link } from "@inertiajs/inertia-react";

import Button from "@mui/material/Button";

// Layouts
import AdminLayout from "../../Layouts/AdminLayout";

export default function LocationsPage() {
    const { locations, success } = usePage().props;

    const handleAddLocationClick = () => {
        setOpenAddLocationDialog(true);
    };

    return (
        <AdminLayout title="Locations">
            {success && (
                <div className="mb-3 alert alert-success">{success}</div>
            )}

            {console.log("success: ", success)}

            <div className="page-section">
                <div className="page-section-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Locations</h5>
                    </div>
                    <div>
                        <Link
                            onClick={handleAddLocationClick}
                            className="btn btn-primary btn-sm"
                            href={route("location.create")}
                        >
                            Add Location
                        </Link>
                    </div>
                </div>
                <div className="page-section-content">
                    {locations.length ? (
                        <>
                            <table className="table">
                                <tbody>
                                    {locations.map((location, i) => (
                                        <tr key={`location-row-${i}`}>
                                            <td>{location.name}</td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </>
                    ) : (
                        <p>No locations.</p>
                    )}
                </div>
            </div>
        </AdminLayout>
    );
}

function AddLocation() {
    const handleSubmit = () => {};

    const handleClose = () => {};

    return (
        <Dialog open={open} onClose={handleClose}>
            <DialogTitle>Add Location</DialogTitle>
            <DialogContent>
                <DialogContentText>
                    Enter a location name to add.
                </DialogContentText>
                <TextField
                    autoFocus
                    margin="dense"
                    id="name"
                    label="Location Name"
                    type="text"
                    fullWidth
                    variant="standard"
                />
            </DialogContent>
            <DialogActions>
                <Button onClick={handleClose}>Cancel</Button>
                <Button onClick={handleSubmit}>Submit</Button>
            </DialogActions>
        </Dialog>
    );
}
