<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;
    protected $fillable = ['pergunta_id', 'resposta'];

    public function rules()
    {
        return [
            'pergunta_id' => 'exists:perguntas,id',
            'resposta' => 'required' . $this->id
        ];
    }

    // O feedback está o retorno padrão do laravel - podemos refatorar se necessário

    public function pergunta()
    {
        //uma resposta pertence a uma pergunta
        return $this->belongsTo('App\Models\Pergunta');
    }
}
