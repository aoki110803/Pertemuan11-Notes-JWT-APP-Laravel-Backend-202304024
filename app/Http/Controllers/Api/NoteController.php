<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
 
class NoteController extends Controller
{
    // GET /api/notes — Ambil semua catatan milik user login
    public function index()
    {
        $notes = auth()->user()->notes()->latest()->get();
        return response()->json(['data' => $notes]);
    }
 
    // POST /api/notes — Buat catatan baru
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
 
        $note = auth()->user()->notes()->create([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);
 
        return response()->json(['message' => 'Catatan dibuat', 'data' => $note], 201);
    }
 
    // GET /api/notes/{id} — Tampilkan satu catatan
    public function show(Note $note)
    {
        $this->authorizeNote($note);
        return response()->json(['data' => $note]);
    }
 
    // PUT /api/notes/{id} — Update catatan
    public function update(Request $request, Note $note)
    {
        $this->authorizeNote($note);
 
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
 
        $note->update($request->only('title', 'content'));
        return response()->json(['message' => 'Catatan diperbarui', 'data' => $note]);
    }
 
    // DELETE /api/notes/{id} — Hapus catatan
    public function destroy(Note $note)
    {
        $this->authorizeNote($note);
        $note->delete();
        return response()->json(['message' => 'Catatan dihapus']);
    }
 
    // ── Helper: pastikan catatan milik user yang login ────────
    private function authorizeNote(Note $note): void
    {
        if ($note->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak');
        }
    }
}
