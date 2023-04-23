<?php 
namespace app\model;

class PaginationHtml
{
    private $links;

    public function __construct()
    {
        $this->links = [];
    }

    public function addLink(string $href = '#',string $value,bool $active = false)
    {
        $active = $active ? 'active' : '';

        $this->links[] = "<li class='page-item {$active}'><a class='page-link' href='{$href}'>{$value}</a></li>";
    }

    public function render()
    {
        $links = !empty($this->links) ? implode(' ',$this->links) : '';
        
        if($links != '')
        {
            $links = "<ul class='pagination'>{$links}</ul>";
        }

        return $links;
    }
}

