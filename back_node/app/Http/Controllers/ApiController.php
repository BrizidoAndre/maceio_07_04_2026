<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResponseResource;
use App\Models\Dialog;
use App\Models\Node;
use App\Models\Response;

class ApiController extends Controller
{


    /**
     * Get next parameters and next questions
     * @param Response $response
     * @return array
     */
    public function next(Response $response)
    {
        $dialog = $response->node->dialog;
        return [
            'question' => $response->answer,
            'name' => $dialog->protagonist_name,
            'id' => $dialog->id,
            'finished' => !$response->nextNode,
            'nextQuestion' => $response?->nextNode?->dialog,
            'hasAction' => (bool)$response->code_object,
            'codeObject' => $response->code_object,
            'codeInventory' => $response->code_inventory,
            'nextAnswers' => ResponseResource::collection($response->nextNode ? $response->nextNode->responses : []),
        ];
    }

    /**
     * Start a new conversation
     * @param Dialog $dialog
     * @return array
     */
    public function start(Dialog $dialog)
    {
        return [
            'data' => ResponseResource::collection($dialog->node->responses),
            'id' => $dialog->id,
            'question' => $dialog->notes,
            'name' => $dialog->protagonist_name,
        ];
    }
}
