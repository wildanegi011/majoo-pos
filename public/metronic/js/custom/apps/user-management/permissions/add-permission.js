"use strict";
var KTUsersAddPermission = function() {
    const t = document.getElementById("kt_modal_add_permission"),
        e = t.querySelector("#kt_modal_add_permission_form"),
        n = new bootstrap.Modal(t);
    return {
        init: function() {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        permission_name: {
                            validators: {
                                notEmpty: {
                                    message: permissionMessage
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });
                t.querySelector('[data-kt-permissions-modal-action="close"]').addEventListener("click",
                        (t => {
                            t.preventDefault(), Swal.fire({
                                text: closeMessage,
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Yes, close it!",
                                cancelButtonText: "No, return",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-active-light"
                                }
                            }).then((function(t) {
                                t.value && n.hide()
                            }))
                        })), t.querySelector('[data-kt-permissions-modal-action="cancel"]')
                    .addEventListener("click", (t => {
                        t.preventDefault(), Swal.fire({
                            text: cancelMessage,
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then((function(t) {
                            t.value ? (e.reset(), n.hide()) : "cancel" === t
                                .dismiss && Swal.fire({
                                    text: cancelForm,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                })
                        }))
                    }));
                const i = t.querySelector('[data-kt-permissions-modal-action="submit"]');
                i.addEventListener("click", (function(t) {
                    t.preventDefault(), o && o.validate().then((function(t) {
                        console.log("validated!"), "Valid" == t ? (i
                            .setAttribute("data-kt-indicator", "on"),
                            i.disabled = !0, setTimeout((function() {
                                i.removeAttribute("data-kt-indicator"),
                                i.disabled = !1,
                                $.ajax({
                                    url: createUrl,
                                    method: 'post',
                                    data: {
                                        _token: token,
                                        name: $('#kt_modal_add_permission_form .permission_name').val(),
                                        guard_name: 'web',
                                        description: $('#kt_modal_add_permission_form .description').val()
                                    }
                                }).done(function(){
                                    Swal.fire({
                                        text: successfullySubmittedForm,
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then((function(t) {
                                        t.isConfirmed && n
                                            .hide()
                                    }))
                                })
                            }), 2e3)) : Swal.fire({
                            text: errorDetected,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }))
                }))
            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTUsersAddPermission.init()
}));
