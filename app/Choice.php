<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'choices';
	
	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
	
	/**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';
		
	/**
	 * Get the User record associated with the user.
	 */
    public function queston()
    {
        return $this->belongsTo('App\Question','id', 'question_id');
    }
}
