<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'content'
    ];

    // TodoからCategoryを呼び出すための設定
    public function category()
    {
        // belongsTo = 「〜に属する」という意味
        return $this->belongsTo(Category::class);
    }

    //$category_idが空でなかった場合、category_idカラムで検索
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id))
        {
            $query->where('category_id', $category_id);
        }
    }

    //$keywordが空出なかった場合、contentで検索
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword))
             {
                //likeは部分一致検索。$keywordの前後にワイルドカードを付けて検索
                $query->where('content','like','%' . $keyword . '%');
            }
        return $query;
    }
}
