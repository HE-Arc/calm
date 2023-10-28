import './bootstrap';

import 'flowbite';

(function () {
    "use strict";

    function getElement(element)
    {
        const elementSearch = document.querySelector(element);
        if(elementSearch)
        {
            console.log(elementSearch)
            return elementSearch;
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
                }
            }
        }
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
    }()); //mainProgram
}()); //Main IIFE
