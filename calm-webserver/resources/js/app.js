import './bootstrap';

import 'flowbite';

(function () {
    "use strict";

    /**
     * Toggle display of element when checkbox change
     * @param checkboxId
     * @param elementId
     */
    function toggleOnCheckboxChange(checkboxId, elementId) {
        const checkbox = document.getElementById(checkboxId);
        const elementToToggle = document.getElementById(elementId);

        if (checkbox && elementToToggle) {
            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    elementToToggle.classList.remove('hidden');
                } else {
                    elementToToggle.classList.add('hidden');
                }
            });
        }
    }

    /**
     * Main program
     */
    (function mainProgram() {

        // Toggle selects for washing machines and dryers on create booking
        toggleOnCheckboxChange("wash", "washing");
        toggleOnCheckboxChange("dry", "drying");

    }()); //mainProgram
}()); //Main IIFE
