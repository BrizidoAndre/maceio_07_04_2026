<?php

namespace App\Http\Controllers;

use App\Models\Dialog;
use App\Models\Node;
use Illuminate\Http\Request;
use function Termwind\render;

class NodeController extends Controller
{
    /**
     * Render the dialog response page
     */
    public function update(Node $node)
    {
        $node->load(['dialogs', 'responses']);
        return view('nodes.update', [
            'model' => $node,
        ]);
    }

    /**
     * Edit all existing responses of a node
     * @param Request $request
     * @param Node $node
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, Node $node)
    {
        $items = collect($request->post())->except(['_token', '_method']);
        $items->each(function ($item, $i) use ($request, $node) {
            $response = $node->responses()->find($i);
            $response->code_object = $item['code_object'];
            $response->code_inventory = $item['code_inventory'];
            $response->answer = $item['answer'];
            $response->next_node_id = $item['next_node_id'];
            $response->save();
        });
        return redirect()->route('home');
    }
}
