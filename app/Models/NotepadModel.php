<?php

namespace App\Models;

use CodeIgniter\Model;

class NotepadModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['content', 'created_at'];
}
  