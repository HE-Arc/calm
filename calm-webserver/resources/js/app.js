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
        // TODO adding the right route
        // button.dataset.reservationId
        form.action = "/management/" + button.dataset.orgId + "/users/"+ button.dataset.userId;
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
    }()); //mainProgram
}()); //Main IIFE
