<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = auth()->user()->contacts()->get();
    return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('contacts.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'last_name' => 'nullable|regex:/^[\pL\s]+$/u|max:30',
            'phone' => 'required|digits:9',
            'email' => 'nullable|email:strict'
        ]);

        $request->user()->contacts()->create($validated);

        return redirect(route('contacts.index'))
            ->with('success', 'Your message has been sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): View
    {
        // Verifica que el usuario autenticado es el propietario del contacto
        if (auth()->user()->id !== $contact->user_id) {
            abort(403, 'No tienes permiso para editar este contacto.');
        }
        return view('contacts.edit', [
            'contact' =>$contact,
        ]);
    }
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        if (auth()->user()->id !== $contact->user_id) {
            abort(403, 'No tienes permiso para actualizar este contacto.');
        }
        $validated = $request->validate([
            'first_name' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'last_name' => 'nullable|regex:/^[\pL\s]+$/u|max:30',
            'phone' => 'required|digits:9',
            'email' => 'nullable|email:strict',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $filePath = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo_path'] = $filePath;
        }

        $contact->update($validated);

        return redirect()->route('contacts.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        if (auth()->user()->id !== $contact->user_id) {
            abort(403, 'No tienes permiso para actualizar este contacto.');
        }
        $contact->delete();

        return redirect(route('contacts.index'));
    }

}
