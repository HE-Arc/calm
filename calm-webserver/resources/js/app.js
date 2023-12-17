import './bootstrap';

import 'flowbite';

(function () {
    "use strict";

    /**
     * Get element in function of what identifiant or class pass
     * @param element identifiant (#<name>) ou classname (.<classname>)
     * @returns {*}
     */
    function getElement(element)
    {
        const elementSearch = document.querySelector(element);
        if(elementSearch)
        {
            //console.log(elementSearch)
            return elementSearch;
        }
    }

    function getElements(elements)
    {
        const elementsSearch = document.querySelectorAll(elements);
        if(elementsSearch)
        {
            return elementsSearch;
        }
    }

    /**
     * Add an event on the element specified
     * @param element : Element to add event
     * @param event : string name
     * @param fun : Function associed
     */
    function addEvent(element, event, fun)
    {
        if(element)
        {
            element.addEventListener(event, fun);
        }
    }

    /**
     * Filter laundries to fit with laundries into the selected organisation
     * @param selectedOrganisation id of the organisation selected
     */
    function filterLaundries(selectedOrganisation) {
        console.log("org = " + selectedOrganisation);
        let organisationId = selectedOrganisation;
        let laundrySelect = document.querySelector(".laundries-field");

        if(organisationId === "")
        {
            laundrySelect.classList.add("hidden");
        } else {
            laundrySelect.classList.remove("hidden");

            let options = laundrySelect.querySelectorAll('option');

            for (let i = 0; i < options.length; i++) {
                let option = options[i];

                option.style.display = 'none';

                if (option.dataset.organisation === organisationId) {
                    option.style.display = 'block';

                    // change the selection for a laundry in org
                    document.getElementById("laundries").value = option.value;
                }
            }
        }
    }

    /**
     * Make checkboxes mutually exclusive, allowing only one option to be selected at a time.
     * @param checkboxes - List of checkbox-type input elements.
     */
    function exclusivesCheckbox(checkboxes)
    {
        if(checkboxes) {
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener("change", function(){
                    if(this.checked) {
                        checkboxes.forEach(function(otherCheckbox) {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.checked = false;
                            }
                        });
                    }
                });
            })
        }
    }

    function deleteUser(button, form)
    {
        form.action = "/management/" + button.dataset.orgId + "/users/"+ button.dataset.userId;
    }

    function deleteUserReservation(button, form)
    {
        form.action = "/management/reservations/" + button.dataset.reservationId;
    }

    function deleteOrganization(button, form)
    {
        form.action = "/management/organizations/" + button.dataset.organizationId;
    }

    function deleteLaundry(button, form)
    {
        form.action = "/management/" + button.dataset.organizationId + "/laundries/" + button.dataset.laundryId;
    }

    function deleteMachine(button, form)
    {
        form.action = "/management/" + button.dataset.organizationId + "/laundries/" + button.dataset.laundryId + "/machines/" + button.dataset.machineId;
    }

    /**
     * Toggle the display of invitation lines based on the checkbox state.
     */
    function toggleInvitaionDisplay()
    {
        const getAllDisabledLines = getElements(".disable-line td");
        if(this.checked)
        {
            // Hide all table cells in disabled rows
            getAllDisabledLines.forEach((element) => {
                element.style.display = "none";
            });
        }
        else
        {
            getAllDisabledLines.forEach((element) => {

                // Determine the display type based on screen width
                let typeDisplay = "block";
                if(window.matchMedia('(min-width: 1024px)').matches)
                {
                    typeDisplay = "table-cell";
                }
                element.style.display = typeDisplay;
            });
        }
    }

    /**
     * Copies the text content of a specified element to the clipboard and provides visual feedback.
     */
    function copyToClipboard()
    {
        let element = this.parentElement.querySelector(".code-to-copy");
        let textToCopy = element.innerText;

        navigator.clipboard.writeText(textToCopy)
            .then(() => {
                let initColor = this.style.color;
                this.style.color = "#8DAAA6";

                setTimeout(() => {
                    this.style.color = initColor;
                }, 3000);
            })
            .catch(err => {
                console.error('Unable to copy text', err);
            });
    }

    /**
     * Main program
     */
    (function mainProgram() {
        // Filter laundries list when user select an organisation
        const selectedOrganisation = getElement("#organisations");
        addEvent(selectedOrganisation, "change", () => {
            filterLaundries(selectedOrganisation.value)
        });

        // Exclusives checkbox between wash and dry in new reservation
        const chooseWashDryCheckboxes = getElements(".choose-wash-dry");
        exclusivesCheckbox(chooseWashDryCheckboxes);

        const adminDeleteUserButtons = getElements(".btn-admin-delete-user-account");
        adminDeleteUserButtons.forEach((button) => {
            addEvent(button, "click", () => {
                deleteUser(button, getElement("#delete-user-account-form"))
            });
        });

        const adminDeleteUserReservationButtons = getElements(".btn-admin-delete-user-reservation");
        adminDeleteUserReservationButtons.forEach((button) => {
            addEvent(button, "click", () => {
                deleteUserReservation(button, getElement("#delete-user-reservation-form"))
            });
        });

        const adminDeleteOrganizationButtons = getElements(".btn-admin-delete-organization");
        adminDeleteOrganizationButtons.forEach((button) => {
            addEvent(button, "click", () => {
                deleteOrganization(button, getElement("#delete-organization-form"))
            });
        })

        const adminDeleteLaundryButtons = getElements(".btn-admin-delete-laundry");
        adminDeleteLaundryButtons.forEach((button) => {
            addEvent(button, "click", () => {
                deleteLaundry(button, getElement("#delete-laundry-form"))
            });
        })

        const adminDeleteMachineButtons = getElements(".btn-admin-delete-machine");
        adminDeleteMachineButtons.forEach((button) => {
            addEvent(button, "click", () => {
                deleteMachine(button, getElement("#delete-machine-form"))
            });
        })


        const toggleInvitationShow = getElement("#showOnlyActivateInvitations");
        addEvent(toggleInvitationShow, "change", toggleInvitaionDisplay);

        const copyToClipboardIcon = getElements(".copy-to-clipboard");
        copyToClipboardIcon.forEach((button) => {
            addEvent(button, "click", copyToClipboard);
        });
    }()); //mainProgram
}()); //Main IIFE
