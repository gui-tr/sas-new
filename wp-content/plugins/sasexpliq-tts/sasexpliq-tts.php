<?php
/**
 * Plugin Name: SASEXPLIQ Text-to-Speech
 * Description: Adds text-to-speech buttons to articles and specific pages
 * Version: 1.0
 * Author: Your Name
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue the TTS script on all pages
function sasexpliq_tts_enqueue_scripts() {
    wp_enqueue_script(
        'sasexpliq-tts',
        plugins_url('js/tts-button.js', __FILE__),
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'sasexpliq_tts_enqueue_scripts');

// Add custom JavaScript for TTS functionality
function sasexpliq_tts_add_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add styles if not already added
        if (!document.getElementById('tts-button-styles')) {
            const style = document.createElement('style');
            style.id = 'tts-button-styles';
            style.textContent = `
                .tts-button-container {
                    display: flex;
                    align-items: center; 
                    margin-left: 10px;
                    height: 100%; 
                }
                .tts-button {
                    width: 30px;
                    height: 30px;
                    background-color: #f05519;
                    border: none;
                    border-radius: 50%;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: background-color 0.3s ease;
                }
                .tts-button:hover {
                    background-color: #d94a15;
                }
                .tts-button svg {
                    color: white;
                    width: 18px;
                    height: 18px;
                }
                .tts-button.speaking {
                    background: #f44336;
                }
                .tts-button.speaking:hover {
                    background: #da190b;
                }
                
                /* Make text blocks flex containers to align with button */
                /* Base styling for all readable elements */
                .tts-readable {
                    display: inline-flex;
                    flex-wrap: nowrap;
                    gap: 10px;
                }

                /* Use baseline alignment by default (for smaller headings) */
                .tts-readable {
                    align-items: baseline;
                }

                /* Target larger headings specifically with center alignment */
                h1.tts-readable,
                .page-title.tts-readable {
                    align-items: center;
                }

                /* For medium headings, you might need a custom adjustment */
                h2.tts-readable {
                    align-items: center;
                }
                
                /* Specific styling for page titles */
                .page-title.tts-readable,
                .section-title.tts-readable {
                    display: flex;
                    align-items: center;
                }
                
                /* Responsive adjustments */
                @media (max-width: 768px) {
                    .tts-button-container {
                        margin-left: 5px;
                    }
                    
                    .tts-button {
                        width: 25px;
                        height: 25px;
                    }
                }
                
                @media (max-width: 480px) {
                    .tts-button-container {
                        margin-left: 8px;
                    }
                }


                /* Add specific handling for larger headings */
                h1.tts-readable .tts-button-container,
                h2.tts-readable .tts-button-container {
                    margin-bottom: 4px; /* Adjust this value based on your font size */
                }

                /* Ensure vertical alignment for all headings */
                .tts-readable h1,
                .tts-readable h2,
                .tts-readable h3 {
                    margin: 0;
                    display: inline-block;
                    vertical-align: middle;
                }
            `;
            document.head.appendChild(style);
        }
        
        // Find all elements that need TTS buttons
        const readableElements = document.querySelectorAll('.tts-readable');
        
        readableElements.forEach(function(element) {
            // Skip if this element already has a TTS button
            if (element.querySelector('.tts-button-container')) {
                return;
            }
            
            // Create a container for the TTS button
            const buttonContainer = document.createElement('div');
            buttonContainer.className = 'tts-button-container';
            
            // Create the button
            const button = document.createElement('button');
            button.className = 'tts-button';
            button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>';
            
            // Find the associated text block
            let textBlock = null;
            
            // If this is a title element, look for the next sibling that might be a text block
            if (element.tagName === 'H1' || element.tagName === 'H2' || element.tagName === 'H3') {
                // Try to find a tts-text-block that follows this title
                const nextElement = element.nextElementSibling;
                if (nextElement && nextElement.classList.contains('tts-text-block')) {
                    textBlock = nextElement;
                } else {
                    // If no direct tts-text-block, look for the next section or paragraph
                    let currentElement = element.nextElementSibling;
                    while (currentElement && !textBlock) {
                        if (currentElement.classList.contains('tts-text-block') || 
                            currentElement.tagName === 'P' || 
                            currentElement.tagName === 'DIV') {
                            textBlock = currentElement;
                        } else {
                            currentElement = currentElement.nextElementSibling;
                        }
                    }
                }
            } else {
                // If this is already a container, use its content
                textBlock = element;
            }
            
            // Get the text content from the appropriate element
            let textContent = '';
            
            // For the À propos page, we need to get the title and the section body
            if (element.closest('.section-text')) {
                const sectionText = element.closest('.section-text');
                const title = sectionText.querySelector('.section-title');
                const body = sectionText.querySelector('.section-body');
                
                if (title && body) {
                    textContent = title.textContent.trim() + '. ' + body.textContent.trim();
                } else {
                    textContent = element.textContent.trim();
                }
            } else if (textBlock) {
                textContent = textBlock.textContent.trim();
            } else {
                // Fallback to the element's own content if no text block found
                textContent = element.textContent.trim();
            }
            
            // Set up TTS functionality
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
                    utterance = new SpeechSynthesisUtterance(textContent);
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
            
            // Add the button to the element
            element.appendChild(buttonContainer);
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'sasexpliq_tts_add_script'); 