"use strict";

function KTDatatable(tableId, routes, columns, columnDefs, callback = null, callback_ = null) {
    // Class definition
    var KTDatatablesServerSide = function() {
        // Shared variables
        var table;
        var dt;
        var filterPayment;

        // Private functions
        var initDatatable = function() {
            dt = $(tableId).DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [
                    [1, 'asc']
                ],
                stateSave: false,
                // select: {
                //     style: 'multi',
                //     selector: 'td:first-child input[type="checkbox"]',
                //     className: 'row-selected'
                // },
                ajax: {
                    url: routes.datatable,
                },
                columns: columns,
                columnDefs: columnDefs
                // Add data-filter attribute
                // createdRow: function(row, data, dataIndex) {
                //     $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
                // }
            });

            table = dt.$;

            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            dt.on('draw', function() {
                initToggleToolbar();
                toggleToolbars();
                handleDeleteRows();
                if(callback) callback(dt)

                KTMenu.createInstances();
            });
        }

        var handleSearchDatatable = function() {
            const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }

        // var handleSearchDatatableInModal = function() {
            // const filterSearch = document.querySelector('[data-kt-docs-table-filter="searchInModal"]');
            // filterSearch.addEventListener('keyup', function(e) {
            //     $('#kt_add_workspace_users_table').DataTable().search(e.target.value).draw();
            // });
        // }

    // Init toggle toolbar
        var initToggleToolbar = function() {
            // Toggle selected action toolbar
            // Select all checkboxes
            const container = document.querySelector(tableId);
            const checkboxes = container.querySelectorAll('[type="checkbox"]');

            // Select elements
            const deleteSelected = document.querySelector('[data-kt-docs-table-select="delete_selected"]');

            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function() {
                    setTimeout(function() {
                        toggleToolbars();
                    }, 50);
                });
            });

            // Deleted selected rows
            if (deleteSelected) {
                deleteSelected.addEventListener('click', function() {
                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete selected users?",
                        icon: "warning",
                        buttonsStyling: false,
                        showCancelButton: true,
                        showLoaderOnConfirm: true,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        },
                    }).then(function(result) {
                        if (result.value) {
                            // Simulate delete request -- for demo purpose only
                            // get selected records
                            var checkedNodes = container.querySelectorAll('[type="checkbox"]:checked');
                            var ids_ = [];
                            for (let i = 0; i < checkedNodes.length; i++) {
                                if (checkedNodes[i] !== undefined) {
                                    console.log(checkedNodes[i].value);
                                    if (checkedNodes[i].checked && checkedNodes[i].value != 1) {
                                        var value = checkedNodes[i].value;
                                        ids_[i] = value;
                                    }
                                }
                            }

                            var ids = ids_.filter(function (el) {
                                return el != null;
                            });

                            $.ajax({
                                url: routes.destroyMany,
                                method: 'delete',
                                data: {
                                    _token: routes.token,
                                    id: ids
                                }
                            }).done(function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        text: "Deleting selected users",
                                        icon: "info",
                                        buttonsStyling: false,
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {
                                        Swal.fire({
                                            text: "You have deleted all selected customers!.",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function() {
                                            // delete row data from server and re-draw datatable
                                            dt.draw();
                                        });

                                        // Remove header checked box
                                        const headerCheckbox = container
                                            .querySelectorAll(
                                                '[type="checkbox"]')[0];
                                        headerCheckbox.checked = false;
                                    });
                                }
                            }).fail(function(xhr){
                                if (xhr.status == 403) {
                                    Swal.fire({
                                        text: "You dont have authorization for this action ",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    })
                                }
                            })

                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Selected customers was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                });
            }
        }

    // Filter Datatable
        var handleFilterDatatable = () => {
            // Select filter options
            // const filterButton = document.querySelector('[data-kt-user-table-filter="filter"]');
            // // // Filter datatable on submit
            // if (filterButton) {
            //     console.log(filterButton.value);
            //     $('#kt_add_workspace_users_table').DataTable().search(filterButton.value).draw();
            //     // dt.search(filterButton.value).draw();
            // //     filterButton.addEventListener('click', function(e) {
            // //         console.log(e);
            // // //         // // Get filter values
            // // //         // let paymentValue = '';

            // // //         // // Get payment value
            // // //         // filterPayment.forEach(r => {
            // // //         //     if (r.checked) {
            // // //         //         paymentValue = r.value;
            // // //         //     }

            // // //         //     // Reset payment value if "All" is selected
            // // //         //     if (paymentValue === 'all') {
            // // //         //         paymentValue = '';
            // // //         //     }
            // // //         // });

            // // //         // // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            // //     });
            // }
        }

        // Toggle toolbars
        var toggleToolbars = function() {
            // Define variables
            const container = document.querySelector(tableId);
            // const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
            const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
            const selectedCount = document.querySelector('[data-kt-docs-table-select="delete_selected"]');

            // Select refreshed checkbox DOM elements
            const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });

            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = "<i class='fa fa-trash'></i><span class='fs-7'> " + count +
                    " selected</span>";
                // toolbarBase.classList.add('d-none');
                if(toolbarSelected) {
                    toolbarSelected.classList.remove('d-none');
                }
            } else {
                // toolbarBase.classList.remove('d-none');
                if(toolbarSelected) {
                    toolbarSelected.classList.add('d-none');
                }
            }
        }

        // Delete customer
        var handleDeleteRows = () => {
            // Select all delete buttons
            const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get customer name
                    const selectedId = parent.querySelectorAll('td .form-check-input')[0].value;
                    const questionIndex = parent.querySelectorAll('td .question-index')[0];
                    const customerName = parent.querySelectorAll('td')[1].innerText;

                    var route = routes.destroy.replace(':id', selectedId)
                    if(questionIndex != undefined) {
                        route = routes.destroy.replace(':id', selectedId).replace(':index', questionIndex.value)
                    }

                    Swal.fire({
                        text: "Are you sure you want to delete " + customerName + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            // Simulate delete request -- for demo purpose only
                            $.ajax({
                                url: route,
                                method: 'delete',
                                data: {
                                    '_token': routes.token
                                }
                            }).done(function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        text: "Deleting " +
                                            customerName,
                                        icon: "info",
                                        buttonsStyling: false,
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {
                                        Swal.fire({
                                            text: "You have deleted " +
                                                customerName +
                                                "!.",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function() {
                                            // delete row data from server and re-draw datatable
                                            dt.draw();
                                        });
                                    });
                                }
                            }).fail(function(xhr){
                                if (xhr.status == 403) {
                                    Swal.fire({
                                        text: "You dont have authorization for this action ",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    })
                                }
                            })
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: customerName + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                })
            });
        }


        // Public methods
        return {
            init: function() {
                initDatatable();
                handleSearchDatatable();
                initToggleToolbar();
                handleFilterDatatable();
                handleDeleteRows();
                if(callback) callback(dt);
                if(callback_) callback_(dt);
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTDatatablesServerSide.init();
    });
}
