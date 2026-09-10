<?php

namespace App\Http\Controllers;

use App\Http\Requests\DialogRequest;
use App\Models\Dialog;
use App\Models\Node;

class PublicController extends Controller
{
    /**
     * renders the index page with query on tag_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\Viewl
     */
    public function index()
    {
        $dialogs = Dialog::with(['node.responses', 'tag']);
        $dialogs->when(request('tag_id'), function ($query, $tagId) {
            $query->where('tag_id', $tagId);
        });
        return view('public.index', [
            'dialogs' => $dialogs->get()
        ]);
    }

    /**
     * Destroy a recorded dialog (but maintain the node refernce)
     * @param Dialog $dialog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Dialog $dialog)
    {
        $dialog->delete();
        return redirect()->route('home');
    }

    /**
     * Render the create form for a new dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function create()
    {
        return view('public.create');
    }

    /**
     * Create a dialog record in the database
     * @param DialogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DialogRequest $request)
    {
        Dialog::create([
            ...$request->validated(),
            'node_id' => (Node::create())->getKey(),
        ]);
        return redirect()->route('home');
    }

    /**
     * renders the dialog update page form
     * @param Dialog $dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit(Dialog $dialog)
    {
        return view('public.edit', [
            'model' => $dialog
        ]);
    }

    /**
     *Update an existing dialog
     * @param DialogRequest $request
     * @param Dialog $dialog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DialogRequest $request, Dialog $dialog)
    {
        $dialog->update([
            ...$request->validated(),
        ]);
        return redirect()->route('home');
    }
}
