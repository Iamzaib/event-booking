<?php

namespace App\Exports;

use App\Models\ContentPage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContentPagesExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    private $ids;
    public function Ids(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function query()
    {
        if(is_countable($this->ids)&&count($this->ids)>1){
            return ContentPage::query()->whereIn('id', $this->ids);
        }
        return ContentPage::query();
    }
    public function headings(): array
    {
        return [
            'Title',
            'Content',
            'excerpt',
            'Category',
            'Tags',
//            'Author',
        ];
    }
    public function map($blogPost): array
    {
        $categories=$tags='';
        foreach ($blogPost->categories as $category){
            $categories.=$category->name.', ';
        }foreach ($blogPost->tags as $tag){
        $tags.=$tag->name.', ';
    }
        return [
            $blogPost->title,
            $blogPost->page_text,
            $blogPost->excerpt,
            $categories,
            $tags,
//            $blogPost->user->name.' '.$blogPost->user->lastname,
        ];
    }
}
