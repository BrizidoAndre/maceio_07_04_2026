/**
 * Dialogue engine prototype
 * This file manages the user interface and prototype interactions.
 * It CANNOT be modified by the competitor.
 */

// Global game variables
window.gameInventory = [];
let currentDialog = null;
let currentNode = null;

/**
 * Prototype initialization
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Prototype Dialog Engine initialized');

    // Initialize events
    initializeEventListeners();

    // Display initial inventory
    updateInventoryDisplay();

    // Welcome message
    updateDebugInfo('Prototype initialized. Click on a character to start a dialogue.');
});

/**
 * Initializes all prototype events
 */
function initializeEventListeners() {
    // Character events
    const characters = document.querySelectorAll('.character');
    characters.forEach(character => {
        character.addEventListener('click', function() {
            const dialogId = this.getAttribute('data-dialog-id');
            if (dialogId) {
                startDialog(dialogId);
            }
        });
    });

    // Event to close the dialogue
    const closeButton = document.getElementById('close-dialog');
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            resetDialog();
        });
    }

    // Close dialogue by clicking on the background
    const dialogSection = document.getElementById('dialog-section');
    if (dialogSection) {
        dialogSection.addEventListener('click', function(e) {
            if (e.target === this) {
                resetDialog();
            }
        });
    }
}

/**
 * Starts a dialogue (called by clicking on a character)
 * @param {string} dialogId - ID of the dialogue to start
 */
function startDialog(dialogId) {
    console.log(`Starting dialog: ${dialogId}`);
    updateDebugInfo(`Attempting to start dialogue: ${dialogId}`);

    // Call the competitor's method
    if (typeof onDialogStart === 'function') {
        onDialogStart(dialogId);
    } else {
        updateDebugInfo('ERROR: The function onDialogStart() is not implemented in dialog-interface.js');
    }
}

/**
 * Displays a dialogue node with its answers
 * This method is provided to the competitor and cannot be modified
 * @param {string} dialogId - Dialogue ID
 * @param {string} protagonistName - Name of the protagonist
 * @param {string} text - Node text
 * @param {Array} answers - List of possible answers
 */
function displayDialogNode(dialogId, protagonistName, text, answers) {
    console.log('Displaying dialog node:', { dialogId, protagonistName, text, answers });

    // Store current dialogue information
    currentDialog = dialogId;
    currentNode = { text, answers };

    // Update the interface
    const dialogSection = document.getElementById('dialog-section');
    const protagonistElement = document.getElementById('dialog-protagonist');
    const textElement = document.getElementById('dialog-text');
    const answersContainer = document.getElementById('dialog-answers');

    if (!dialogSection || !protagonistElement || !textElement || !answersContainer) {
        console.error('Dialog elements not found in DOM');
        return;
    }

    // Display the dialogue
    dialogSection.style.display = 'flex';
    protagonistElement.textContent = protagonistName;
    textElement.textContent = text;

    // Clear previous answers
    answersContainer.innerHTML = '';

    // Add new answers
    answers.forEach((answer, index) => {
        const answerElement = document.createElement('div');
        answerElement.className = 'dialog-answer';
        answerElement.textContent = answer.text;

        // Handle answer accessibility
        if (!answer.accessible) {
            answerElement.classList.add('disabled');
            answerElement.title = 'This answer is not available (required item missing)';
        } else {
            answerElement.addEventListener('click', function() {
                selectAnswer(dialogId, answer.id);
            });
        }

        // Appearance animation
        answerElement.style.animationDelay = `${index * 0.1}s`;

        answersContainer.appendChild(answerElement);
    });

    updateDebugInfo(`Node displayed: "${text}" with ${answers.length} answer(s)`);
}

/**
 * Processes the selection of an answer
 * @param {string} dialogId - Dialogue ID
 * @param {string} answerId - ID of the selected answer
 */
function selectAnswer(dialogId, answerId) {
    console.log(`Answer selected: ${answerId} in dialog: ${dialogId}`);

    if (!currentNode) {
        console.error('No current node available');
        return;
    }

    // Find the selected answer
    const selectedAnswer = currentNode.answers.find(answer => answer.id === answerId);
    if (!selectedAnswer) {
        console.error(`Answer ${answerId} not found in current node`);
        return;
    }

    // Check if the answer is accessible
    if (!selectedAnswer.accessible) {
        updateDebugInfo('This answer is not accessible');
        return;
    }

    updateDebugInfo(`Selected answer: "${selectedAnswer.text}"`);

    // Call the competitor's method
    if (typeof onDialogSelectedAnswer === 'function') {
        // We don't know the current node ID, using a placeholder
        const currentNodeId = 'current-node'; // The competitor must handle this in their implementation
        onDialogSelectedAnswer(dialogId, currentNodeId, answerId, window.gameInventory);
    } else {
        updateDebugInfo('ERROR: The function onDialogSelectedAnswer() is not implemented in dialog-interface.js');
    }
}

/**
 * Clears the dialogue from the screen
 * This method is provided to the competitor and cannot be modified
 */
function resetDialog() {
    console.log('Resetting dialog');

    const dialogSection = document.getElementById('dialog-section');
    if (dialogSection) {
        dialogSection.style.display = 'none';
    }

    // Reset variables
    currentDialog = null;
    currentNode = null;

    updateDebugInfo('Dialogue closed');
}

/**
 * Adds an item to the inventory
 * This method is provided to the competitor and cannot be modified
 * @param {string} itemCode - Code of the item to add
 */
function addItemToInventory(itemCode) {
    console.log(`Adding item to inventory: ${itemCode}`);

    if (!window.gameInventory.includes(itemCode)) {
        window.gameInventory.push(itemCode);
        updateInventoryDisplay();
        updateDebugInfo(`Item added to inventory: ${itemCode}`);
    } else {
        updateDebugInfo(`Item already present in inventory: ${itemCode}`);
    }
}

/**
 * Updates the inventory display
 */
function updateInventoryDisplay() {
    const inventoryContainer = document.getElementById('inventory-items');
    if (!inventoryContainer) return;

    inventoryContainer.innerHTML = '';

    if (window.gameInventory.length === 0) {
        inventoryContainer.innerHTML = '<div class="inventory-empty">Empty</div>';
        return;
    }

    window.gameInventory.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'inventory-item';
        itemElement.textContent = getItemDisplayName(item);
        itemElement.title = `Code: ${item}`;
        inventoryContainer.appendChild(itemElement);
    });
}

/**
 * Converts an item code to a display name
 * @param {string} itemCode - Item code
 * @returns {string} - Display name
 */
function getItemDisplayName(itemCode) {
    const itemNames = {
        'gold-coin': '🪙 Gold Coin',
        'silicon-rod': '🔧 Silicon Rod',
        'telescope': '🔭 Telescope',
        'note': '📝 Note'
    };

    return itemNames[itemCode] || `📦 ${itemCode}`;
}

/**
 * Updates debug information
 * @param {string} message - Message to display
 */
function updateDebugInfo(message) {
    const debugElement = document.getElementById('debug-info');
    if (debugElement) {
        const timestamp = new Date().toLocaleTimeString();
        const newMessage = `[${timestamp}] ${message}`;

        // Add the new message
        if (debugElement.innerHTML.includes('Click on a character')) {
            debugElement.innerHTML = newMessage;
        } else {
            debugElement.innerHTML += '<br>' + newMessage;
        }

        // Limit the number of lines to avoid clutter
        const lines = debugElement.innerHTML.split('<br>');
        if (lines.length > 10) {
            debugElement.innerHTML = lines.slice(-10).join('<br>');
        }

        debugElement.scrollTop = debugElement.scrollHeight;
    }
}

// Utility functions for development
window.debugFunctions = {
    addTestItem: function(itemCode) {
        addItemToInventory(itemCode);
    },
    clearInventory: function() {
        window.gameInventory = [];
        updateInventoryDisplay();
        updateDebugInfo('Inventory cleared');
    },
    showInventory: function() {
        console.log('Current inventory:', window.gameInventory);
        return window.gameInventory;
    }
};

console.log('Prototype functions loaded. Debug functions available in window.debugFunctions');