<?php

namespace App\Models;

use App\I18n\Translatable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Todo
 *
 * @property int $id
 * @property int $done
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Todo newModelQuery()
 * @method static Builder|Todo newQuery()
 * @method static Builder|Todo query()
 * @method static Builder|Todo whereCreatedAt($value)
 * @method static Builder|Todo whereDone($value)
 * @method static Builder|Todo whereId($value)
 * @method static Builder|Todo whereText($value)
 * @method static Builder|Todo whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Todo extends Model
{
    use HasFactory, Translatable;

    public $translatables = ['text'];
    protected $with = ['translations'];
    protected $table = 'todos';
	protected $fillable = ['done','text'];

    public function getTextAttribute($value)
    {
        return $this->trans->text ?? $value;
    }

    public function getDoneIconAttribute()
    {
        $css = $this->done ? 'check' : 'times';
        return "<i class=\"fas fa-$css\"></i>";
    }
}
