<?php

namespace App\Controllers;

use App\Models\NotepadModel;
use CodeIgniter\Controller;

class Notepad extends Controller
{
    public function index()
    {
        $model = new NotepadModel();
        $data['notes'] = $model->findAll();
        return view('notepad_view', $data);
    }
    public function save()
    {
        $model = new NotepadModel();
        $content = $this->request->getPost('content');
        $model->save(['content' => $content]);
        return redirect()->to('/notepad');
    }
    public function delete($id)
    {
        $model = new NotepadModel();
        $model->delete($id);
        return redirect()->to('/notepad');
    }
    public function export($id)
    {
        $model = new NotepadModel();
        $note = $model->find($id);
        header(header: 'Content-Type: application/msword');
        header(header: 'Content-Disposition: attachment; filename="note.doc');
        echo $note['content'];
        exit;
    }
}
