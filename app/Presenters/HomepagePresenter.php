<?php

declare(strict_types=1);

namespace App\Presenters;

use MyOrm\SchoolsRepository;
use Nextras\Orm\Entity\Entity;
use Nette;
use Nette\Utils\Strings;



final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /**  
     * @var SchoolsRepository 
     * @inject 
     */
    public $schoolsRepository;

    /**  
     * @var String
     * Helper variable, just to translate
     */
    private String $sort = 'school-ASC';



    public function renderDefault(): void
    {
        $column = Strings::before($this->sort, '-');
        $this->template->column = $column;
        switch ($column) {
            case 'school':
                $column = 'nazev';
                break;
            case 'town':
                $column = 'mesto->nazev';
                break;
        }
        $direction = Strings::after($this->sort, '-');
        $this->template->direction = $direction;



        $schools = $this->schoolsRepository->findAll()->orderBy($column, $direction);
        $this->template->schools = $schools;
    }

    public function handleSort(String $sort): void
    {
        $this->sort = $sort;
    }
}
