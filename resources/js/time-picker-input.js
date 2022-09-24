export default function timePickerInput({ id }) {
    const input = document.querySelector(`input[id="${id}"]`);
    const timeRegex = /^([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/;

    /**
     * Convert seconds to time string.
     * @param {number} value Time in seconds.
     * @returns {string} Time string in format HH:MM:SS.
     */
    const secondToTimeString = (value = 0) => {
        const hours = Math.floor(value / 3600);
        const minutes = Math.floor((value - hours * 3600) / 60);
        const seconds = value - hours * 3600 - minutes * 60;

        return `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
    }

    /**
     * Convert time string to seconds.
     * @param {string} timeString Time string in format HH:MM:SS.
     * @returns {number} Time in seconds.
     */
    const timeStringToSeconds = (timeString) => {
        const [hours, minutes, seconds] = timeString.split(':');
        const totalSeconds = parseInt(hours) * 3600 + parseInt(minutes) * 60 + parseInt(seconds);

        return totalSeconds;
    }

    /**
     * Pad number with leading zero.
     * @param {number} value Number to pad.
     * @returns {string} Padded number.
     */
    const pad = (value = 0) => {
        return value.toString().padStart(2, '0');
    }

    /**
     * Render the time picker input.
     */
    const render = () => {
        const value = input.getAttribute('value');

        const hiddenInput = `
            <input type="hidden" name="${input.getAttribute('id')}" value="${value || 0}">
        `;

        input.insertAdjacentHTML('beforebegin', hiddenInput);
        input.setAttribute('value', secondToTimeString(value));
    }

    /**
     * Render the error message.
     * @param {string} message Error message.
     */
    const renderError = (message = '') => {
        // Clear any existing error messages
        clearError();

        const errorMessage = `
            <span class="invalid-feedback" role="alert">
                <strong>${message || 'Invalid time format'}</strong>
            </span>
        `;

        input.insertAdjacentHTML('afterend', errorMessage);
        input.classList.add('is-invalid');
    }

    /**
     * Clear the error message.
     */
    const clearError = () => {
        const error = input.nextElementSibling;

        if (error && error.classList.contains('invalid-feedback')) {
            error.remove();
        }

        input.classList.remove('is-invalid');
    }

    // Handle input change
    input.addEventListener('input', (event) => {
        const value = event.target.value;

        if (timeRegex.test(value)) {
            clearError();

            const hiddenInput = input.previousElementSibling;
            hiddenInput.value = timeStringToSeconds(value);
        } else {
            renderError();
        }
    });

    render();

    return input;
}
