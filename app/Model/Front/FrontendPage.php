<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
class FrontendPage extends BaseModel
{
    protected $table = 'frontend_pages';
    protected $fillable = ['parent_page_id', 'slug', 'name', 'content', 'url', 'publish'];
}
