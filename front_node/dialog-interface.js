/**
 * Dialogue Interface - File to complete
 * DO NOT MODIFY ANYTHING OTHER THAN THE CONTENT OF THIS FILE!
 */

/*
    // Example code to display a dialogue


    // Example code to add items to the inventory
*/

/**
 * Method called when a dialogue is triggered (clicking on a character)
 * @param {string} dialogId - ID of the dialogue to start
 */
async function onDialogStart(dialogId) {
    try {
        const res = await start(dialogId);
        const data = await res.json();
        protagonistName = data.name;
        displayDialogNode(data.id, protagonistName, data.question, data.data);
    } catch (error) {
        console.error('Error starting dialog:', error);
        updateDebugInfo(`Error starting dialogue: ${error.message}`);
    }
}

/**
 * Method called when an answer is selected in a dialogue
 * @param {string} dialogId - ID of the current dialogue
 * @param {string} dialogNodeId - ID of the current node
 * @param {string} answerId - ID of the selected answer
 * @param {Array<string>} inventory - Player's current inventory (array of item codes)
 */
async function onDialogSelectedAnswer(dialogId, dialogNodeId, answerId, inventory) {
    try {
        const res = await next(answerId);
        const data = await res.json();
        console.log(data);
        if (data.finished) {
            resetDialog()
        } else {
            let question = data.nextQuestion;
            let answers = data.nextAnswers;
            if (data.hasAction) {
                if (data.codeInventory === 'take') {
                    addItemToInventory(data.codeObject);
                } else {
                    window.gameInventory = [];
                    updateInventoryDisplay();
                }
            }
            displayDialogNode(data.id, protagonistName, question.notes, answers);
        }
        updateDebugInfo(`Selected answer: ${answerId} in node: ${dialogNodeId}`);
    } catch (error) {
        console.error('Error processing selected answer:', error);
        updateDebugInfo(`Error processing answer: ${error.message}`);
    }
}

/**
 * Utility to update debug information - Optional
 * @param {string} message - Message to display
 */
function updateDebugInfo(message) {
    const debugElement = document.getElementById('debug-info');
    if (debugElement) {
        const timestamp = new Date().toLocaleTimeString();
        debugElement.innerHTML += `<br>[${timestamp}] ${message}`;
        debugElement.scrollTop = debugElement.scrollHeight;
    }
}

const API_URL = 'http://10.83.10.161/nodes/api';
let protagonistName;

/**
 *
 * @param node_Id
 * @returns {Promise<Response>}
 */
async function start(node_Id) {
    return await fetch(API_URL + '/start/' + node_Id);
}

async function next(question_id) {
    const query = new URLSearchParams();
    if (window.gameInventory.length > 0) {
        // always getting the first element of inventory
        query.append('item', window.gameInventory[0])
    }
    const url = API_URL + '/next/' + question_id + '?' + query.toString();
    return await fetch(url)
}