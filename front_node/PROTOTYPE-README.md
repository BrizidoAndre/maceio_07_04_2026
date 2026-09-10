# Prototype - Dialogue Engine

This prototype implements the dialogue system described in module D, with 3 characters and their respective dialogue scenarios.

## How to use the prototype

### Competitor version (`index.html`)
1. Open `index.html` in a browser
2. Characters are displayed but dialogues don't work
3. The competitor must implement the methods in `dialog-interface.js`

## Implemented scenarios

### 1. Halite (dialog-1) - Simple scenario
- Linear dialogue without constraints
- 4 dialogue nodes
- Multiple possible paths

### 2. Guard (dialog-2) - Object constraint
- Requires a gold coin for certain responses
- Demonstration of conditional responses
- 4 nodes with branches

### 3. Mom (dialog-3) - Reward and back-and-forth between nodes
- Gives a gold coin if you're polite
- Branches according to the chosen approach
- 4 nodes with reward logic

## Prototype features

### Functions usable by the competitor from dialog-interface.js
```javascript
// Display a dialogue node (see below for the expected format for "answers")
displayDialogNode(dialogId, protagonistName, text, answers)

// Close the dialogue
resetDialog()

// Add an object to inventory
addItemToInventory(itemCode)
```

### Functions to implement by the competitor
```javascript
// When starting a dialogue
async function onDialogStart(dialogId)

// When a response is selected in an ongoing dialogue
async function onDialogSelectedAnswer(dialogId, dialogNodeId, answerId, inventory)
```

## Data structure

### Response format for `displayDialogNode()`
```javascript
const answers = [
    {
        id: "answer-1-1-1",
        text: "Response text",
        accessible: true // the response is grayed out (false) or accessible (true)
    }
];
```

## Testing scenarios

### Halite scenario
1. Click on Halite
2. Test the different dialogue paths
3. Verify that all responses work

### Guard scenario
1. Click on the Guard without a gold coin
2. Observe that the "corruption" response is grayed out
3. Add a gold coin with the debug button, or go get it from your mother.
4. Restart the dialogue and test the corruption (the gold coin doesn't disappear from inventory, it's not required)

### Mom scenario
1. Test the direct approach (ask for money)
2. Test the polite approach (ask how she is)
3. Verify that the gold coin is added to inventory

## Debug and development

### Available debug functions
```javascript
// Add a test object
window.debugFunctions.addTestItem('gold-coin')

// Clear inventory
window.debugFunctions.clearInventory()

// View current inventory
window.debugFunctions.showInventory()
```

### Additional debug methods (for information)

To facilitate testing and development, additional debug methods are available in the browser console:

```javascript
// Add an object directly to inventory to test scenarios
window.debugFunctions.addTestItem('gold-coin')
window.debugFunctions.addTestItem('silicon-rod')
window.debugFunctions.addTestItem('telescope')

// Completely clear inventory
window.debugFunctions.clearInventory()

// Display current inventory content
window.debugFunctions.showInventory()

// Usage examples for tests:
// 1. Test the guard scenario with corruption:
//    window.debugFunctions.addTestItem('gold-coin')
//    then click on the Guard
//
// 2. Reset inventory between tests:
//    window.debugFunctions.clearInventory()
//
// 3. Check inventory state:
//    window.debugFunctions.showInventory()
```

**Note:** These methods are provided solely for testing and debugging purposes. They allow simulating different inventory states without having to go through all dialogues to obtain the necessary objects.
