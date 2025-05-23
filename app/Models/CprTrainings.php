<?phpnamespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CprTraining extends Model
{
    protected $dates = ['date'];

    protected $fillable = [
        'team_member_id',
        'date',
        'time',
        'type',
        'screenshot',
        'score'
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id', 'id');
    }
}