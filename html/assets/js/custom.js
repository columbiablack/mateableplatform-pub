/*
 * Copyright (c) 2024-2026. Mateable LLC
 */

document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const messageElement = document.getElementById('invalid-feedback');

    if (file) {
        const fileType = file.type;
        console.log('Selected file type:', fileType);

        // Check if the file type is a valid video format
        if (fileType.startsWith('video/')) {
            messageElement.textContent = 'The selected file is a valid video format.';
            messageElement.style.color = 'green';
        } else {
            messageElement.textContent = 'The selected file is not a valid video format.';
            messageElement.style.color = 'red';
        }
    } else {
        messageElement.textContent = 'No file selected.';
        messageElement.style.color = 'black';
    }
});


function userOverlayOn() {
    document.getElementById("userOverlay").classList.add("show");
}

function userOverlayOff() {
    document.getElementById("userOverlay").classList.remove("show");
}
