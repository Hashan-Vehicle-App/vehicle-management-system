import React, { useState, useRef } from "react";

export default function AddItemModal({ addButtonText, modalTitle, children }) {
    const [formSubmitCount, setFormSubmitCount] = useState(0);
    const closeBtnRef = useRef();

    function handleSubmitButtonClick() {
        setFormSubmitCount((count) => count + 1);
    }

    function onSuccessFormSubmit() {
        closeBtnRef.current.click();
    }

    return (
        <>
            <button
                type="button"
                className="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"
            >
                {addButtonText}
            </button>

            <div
                className="modal fade"
                id="staticBackdrop"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabIndex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
            >
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5
                                className="modal-title"
                                id="staticBackdropLabel"
                            >
                                {modalTitle}
                            </h5>
                            <button
                                type="button"
                                className="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div className="modal-body">
                            {React.cloneElement(children, {
                                formSubmitCount: formSubmitCount,
                                onSuccessFormSubmit: onSuccessFormSubmit,
                            })}
                        </div>
                        <div className="modal-footer">
                            <button
                                ref={closeBtnRef}
                                type="button"
                                className="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>
                            <button
                                type="button"
                                className="btn btn-primary"
                                onClick={handleSubmitButtonClick}
                            >
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
