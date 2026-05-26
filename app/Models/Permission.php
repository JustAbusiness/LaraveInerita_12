<?php

namespace App\Models;

use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
   use SoftDeletes, HasQuery;

   protected $fillable = [
      'name',
      'description',
      'canonical',
      'user_id',
      'publish',
      'deleted_at'
   ];

   protected $relationtable = [ 
   ]; 

   protected $casts = [
      'publish' => 'integer',
      'created_at' => 'datetime:Y-m-d H:i',
      'updated_at' => 'datetime:Y-m-d H:i',
   ];

   public function creators(): BelongsTo
   { 
      return $this->belongsTo(User::class, 'user_id', 'id') ;
   }

   public function user_catalogues(): BelongsToMany
   {
      return $this->belongsToMany(UserCatalogue::class, 'user_catalogue_permission');
   }

   public function getRelationable()
   {
      return $this->relationtable;
   }


}
