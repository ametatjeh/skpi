<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateSkpi;
use Illuminate\Http\Request;


class TemplateSkpiController extends Controller
{
    /**
     * Halaman edit template SKPI (single record)
     */
    public function edit()
    {
        // Ambil baris pertama, kalau belum ada buat default
        $template = TemplateSkpi::first();

        if (! $template) {
            $template = TemplateSkpi::create([
                'nama_pt' => 'Universitas Iskandar Muda',
                'bahasa_pengantar' => 'Indonesia',
            ]);
        }

        return view('admin.template.index', compact('template'));
    }

    /**
     * Update template SKPI
     */
    public function update(Request $request)
    {
        $template = TemplateSkpi::firstOrFail();

        $data = $request->validate([
            'nama_pt' => 'required|string|max:255',
            'alamat_pt' => 'nullable|string',
            'bahasa_pengantar' => 'required|string|max:100',
            'sk_pendirian' => 'nullable|string|max:255',
            'status_akreditasi' => 'nullable|string|max:100',
            'nomor_sk_akreditasi' => 'nullable|string|max:255',
            'nomor_sk_pt' => 'nullable|string|max:255',
            'persyaratan_penerimaan' => 'nullable|string',
            'sistem_penilaian' => 'nullable|string',
            'lama_studi_reguler' => 'nullable|string|max:100',
        ]);

        $template->update($data);

        return redirect()
            ->route('admin.template-skpi.edit')
            ->with('success', 'Template SKPI berhasil diperbarui');
    }
}
