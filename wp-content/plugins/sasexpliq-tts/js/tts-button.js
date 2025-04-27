// TTS Button functionality
function createTTSButton(text) {
    // Create button container
    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'tts-button-container';
    
    // Create button
    const button = document.createElement('button');
    button.className = 'tts-button';
    button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>';
    
    // Add styles
    const style = document.createElement('style');
    style.textContent = `
        .tts-button-container {
            margin: 10px 0;
            text-align: center;
        }
        .tts-button {
            background: #4CAF50;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }
        .tts-button:hover {
            background: #45a049;
        }
        .tts-button svg {
            color: white;
        }
        .tts-button.speaking {
            background: #f44336;
        }
        .tts-button.speaking:hover {
            background: #da190b;
        }
    `;
    document.head.appendChild(style);

    let utterance = null;
    let isSpeaking = false;

    function getFrenchVoice() {
        const voices = window.speechSynthesis.getVoices();
        // Try to find a French voice
        const frenchVoice = voices.find(voice => voice.lang.startsWith('fr'));
        if (frenchVoice) {
            console.log('Using French voice:', frenchVoice.name);
            return frenchVoice;
        }
        // If no French voice, use the first available voice
        if (voices.length > 0) {
            console.log('No French voice found, using:', voices[0].name);
            return voices[0];
        }
        return null;
    }

    function toggleSpeech() {
        if (isSpeaking) {
            window.speechSynthesis.cancel();
            isSpeaking = false;
            button.classList.remove('speaking');
            button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>';
        } else {
            utterance = new SpeechSynthesisUtterance(text);
            const voice = getFrenchVoice();
            if (voice) {
                utterance.voice = voice;
            }
            
            utterance.onstart = () => {
                isSpeaking = true;
                button.classList.add('speaking');
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>';
            };
            
            utterance.onend = () => {
                isSpeaking = false;
                button.classList.remove('speaking');
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>';
            };
            
            utterance.onerror = (event) => {
                console.error('Speech synthesis error:', event);
                isSpeaking = false;
                button.classList.remove('speaking');
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>';
            };
            
            window.speechSynthesis.speak(utterance);
        }
    }

    button.addEventListener('click', toggleSpeech);
    buttonContainer.appendChild(button);
    return buttonContainer;
}

// Function to add TTS buttons to text blocks
function addTTSButtons() {
    // Wait for voices to be loaded
    if (window.speechSynthesis.getVoices().length === 0) {
        window.speechSynthesis.addEventListener('voiceschanged', () => {
            addTTSButtonsToText();
        });
    } else {
        addTTSButtonsToText();
    }
}

function addTTSButtonsToText() {
    // Find all text blocks that need TTS buttons
    const textBlocks = document.querySelectorAll('.tts-text-block');
    textBlocks.forEach(block => {
        if (!block.nextElementSibling?.classList.contains('tts-button-container')) {
            const button = createTTSButton(block.textContent);
            block.parentNode.insertBefore(button, block.nextSibling);
        }
    });
}

// Initialize when the DOM is loaded
document.addEventListener('DOMContentLoaded', addTTSButtons); 