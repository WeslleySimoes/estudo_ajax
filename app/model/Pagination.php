<?php

namespace app\model;

class CurrentPageException extends \Exception{}

class Pagination
{
    private $currentPage = 1;   // Página atual
    private $totalPages;        // Total de registros da query
    private $linksPerPage = 2;  // total de links ao lado do link ativo, por exemplo 2 links a esquerda e a direto do link atual
    private $itemsPerPage = 15;  // Total de registro por página
    private $totalItems;        // Total de registros para gerar paginação
    private $pageIdentifier = 'page';

    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
    }

    public function setPageIdentifier($pageIdentifier)
    {
        $this->pageIdentifier = $pageIdentifier;
    }

    private function calculations()
    {
        $this->currentPage = $_GET[$this->pageIdentifier] ?? 1;

        $offset = ($this->currentPage - 1) * $this->itemsPerPage;
        
        $this->totalPages = ceil($this->totalItems / $this->itemsPerPage);

        if($this->currentPage < 1 OR ($this->totalPages > 0 AND $this->currentPage > $this->totalPages))
        {
            throw new CurrentPageException('Página inválida');
        }

        return " LIMIT {$this->itemsPerPage} OFFSET {$offset} ";
    }

    public function links()
    {
        $paginationHTML = new PaginationHtml;

        // PÁGINA ANTERIOR E PRIMEIRA PÁGINA
        if($this->currentPage > 1)
        {
            $previus = $this->currentPage - 1;
            
            // link para a página anterior a atual
            $linkPage = http_build_query(array_merge($_GET,[$this->pageIdentifier => $previus])); 
            
            //Link para primeira página
            $first = http_build_query(array_merge($_GET,[$this->pageIdentifier => 1])); 

            $paginationHTML->addLink("?{$first}",'Primeira Página');
            $paginationHTML->addLink("?{$linkPage}",'Anterior');
        }

        if($this->currentPage > 1)
        {
            $contador_inicial = ($this->currentPage - $this->linksPerPage) <= 0 ? 1 : ($this->currentPage - $this->linksPerPage);

            for ($i = $contador_inicial; $i < $this->currentPage ; $i++){ 
                $linkPage = http_build_query(array_merge($_GET,[$this->pageIdentifier => $i]));

                $paginationHTML->addLink("?{$linkPage}",$i);
            }
        }

        if($this->totalPages > 1)
        {
            $linkPage = http_build_query(array_merge($_GET,[$this->pageIdentifier => $this->currentPage]));
            $paginationHTML->addLink("?{$linkPage}",$this->currentPage,true);

        }
     
        if($this->currentPage < $this->totalPages)
        {
            $contador_inicial = ($this->currentPage+$this->linksPerPage) > $this->totalPages ? $this->totalPages : ($this->currentPage+$this->linksPerPage) ;

            for ($i = $this->currentPage + 1; $i <=  $contador_inicial; $i++){ 
                $linkPage = http_build_query(array_merge($_GET,[$this->pageIdentifier => $i]));

                $paginationHTML->addLink("?{$linkPage}",$i);
            }
        }

        // PRÓXIMA PÁGINA E ÚLTIMA PÁGINA
        if($this->currentPage < $this->totalPages)
        {
            $next = $this->currentPage + 1;
            
            // link para a próxima página
            $linkPage = http_build_query(array_merge($_GET,[$this->pageIdentifier => $next])); 
            
            //Link para última página
            $last = http_build_query(array_merge($_GET,[$this->pageIdentifier => $this->totalPages])); 

            $paginationHTML->addLink("?{$linkPage}",'Próxima');
            $paginationHTML->addLink("?{$last}",'Última Página');
        }

        return $paginationHTML->render();
    }

    public function dump()
    {
        return $this->calculations();
    }
}