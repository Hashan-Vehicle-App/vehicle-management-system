import React from "react";

export default function Locations({ locations }) {
    return (
        <>
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
        </>
    );
}
