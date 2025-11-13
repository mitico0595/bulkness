<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Campaign;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $isActive = !empty($data['is_active']);

        // Si esta campaña se marca como activa, desactivamos las demás
        if ($isActive) {
            Campaign::where('is_active', true)->update(['is_active' => false]);
        }

        Campaign::create([
            'name'      => $data['name'],
            'is_active' => $isActive,
        ]);

        return redirect()
            ->route('admin.index_images.index')
            ->with('status', 'Campaña creada correctamente.');
    }
}
