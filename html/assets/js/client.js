/*
 * Copyright (c) 2024-2026. Mateable LLC
 */

const localVideo = document.getElementById('localVideo');
const remoteVideo = document.getElementById('remoteVideo');
const startButton = document.getElementById('startButton');
const callButton = document.getElementById('callButton');
const stopButton = document.getElementById('stopButton');
const remoteButton = document.getElementById('remoteButton');

let localStream;
let peerConnection;
const socket = io('http://localhost:8080');

// Function to start webcam
async function startWebcam() {
    try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        localVideo.srcObject = localStream;
    } catch (error) {
        console.error('Error accessing webcam:', error);
    }
}

// Function to stop webcam
function stopWebcam() {
    if (localStream) {
        localStream.getTracks().forEach(track => {
            track.stop();
        });
        localVideo.srcObject = null;
    }
}

// Function to initiate call to peer
function callPeer() {
    // Implement WebRTC peer connection logic here
}

// Function to end call
function endCall() {
    if (peerConnection) {
        peerConnection.close();
        peerConnection = null;
    }
}

// Function to handle signaling messages
function handleSignalingMessage(message) {
    const signal = JSON.parse(message);
    console.log('Received signaling message:', signal);

    if (signal.type === 'offer') {
        handleOffer(signal);
    } else if (signal.type === 'answer') {
        handleAnswer(signal);
    } else if (signal.type === 'candidate') {
        handleCandidate(signal);
    }
}

// Function to handle offer message
function handleOffer(offer) {
    // Create peer connection if not already exists
    if (!peerConnection) {
        createPeerConnection();
    }

    // Set remote description
    peerConnection.setRemoteDescription(new RTCSessionDescription(offer))
        .then(() => {
            // Create answer
            return peerConnection.createAnswer();
        })
        .then((answer) => {
            // Set local description
            return peerConnection.setLocalDescription(answer);
        })
        .then(() => {
            // Send answer to remote peer
            sendMessage({
                type: 'answer',
                sdp: peerConnection.localDescription
            });
        })
        .catch((error) => {
            console.error('Error handling offer:', error);
        });
}

// Function to handle answer message
function handleAnswer(answer) {
    peerConnection.setRemoteDescription(new RTCSessionDescription(answer.sdp))
        .catch((error) => {
            console.error('Error handling answer:', error);
        });
}

// Function to handle ICE candidate message
function handleCandidate(candidate) {
    peerConnection.addIceCandidate(new RTCIceCandidate(candidate))
        .catch((error) => {
            console.error('Error handling ICE candidate:', error);
        });
}

// Function to send signaling message to server
function sendMessage(message) {
    socket.send(JSON.stringify(message));
}

// Event listeners for signaling messages
socket.on('connect', () => {
    console.log('Connected to signaling server');
});

socket.on('message', (message) => {
    console.log('Received message:', message);
    // Handle received signaling message
    handleSignalingMessage(message);
});

socket.on('disconnect', () => {
    console.log('Disconnected from signaling server');
});

// Event listeners for buttons
startButton.addEventListener('click', startWebcam);
stopButton.addEventListener('click', stopWebcam);
callButton.addEventListener('click', callPeer);
stopButton.addEventListener('click', endCall);

// Remote button functionality (replace with actual functionality)
remoteButton.addEventListener('click', () => {
    console.log('Remote button clicked');
});
