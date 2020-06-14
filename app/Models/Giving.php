<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Giving extends Model
{
  protected $table = 'my_giving.giving';

  protected $fillable = ['id', 'date',  'giving', 'purpose', 'user_id'];

  protected $guarded = array('id');

  public static $rules = array(
      'giving' => [ 'required', 'integer' ],
      'user_id' => [ 'required', 'string' ],
      'date' => 'string',
      'purpose' => 'string',

  );

  public function user()
    {
      return $this->belongsTo('App\Models\User');
    }
}
