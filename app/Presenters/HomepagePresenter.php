<?php

declare(strict_types=1);

namespace App\Presenters;

use MyOrm\SchoolsRepository;
use MyOrm\AcceptsRepository;
use MyOrm\TownsRepository;
use MyOrm\ProfessionsRepository;
use Nette;
use Nette\Utils\Strings;
use Nette\Application\UI\Form;



final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /**  
     * @var SchoolsRepository 
     * @inject 
     */
    public $schoolsRepository;

    /**  
     * @var AcceptsRepository 
     * @inject 
     */
    public $acceptsRepository;

    /**  
     * @var TownsRepository 
     * @inject 
     */
    public $townsRepository;

    /**  
     * @var ProfessionsRepository
     * @inject 
     */
    public $professionsRepository;


    /**  
     * @var String
     * Variable to store information about sorting
     */
    private String $sort = 'school-ASC';

    /**  
     * @var String
     * Variable to store information about sorting
     */
    private String $filter = 'all';

    private $schools;



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


        if ($this->filter == "all") {
            $this->schools = $this->schoolsRepository->findAll()->orderBy($column, $direction);
        } else {

            $category = Strings::before($this->filter, '-');
            $criteria = Strings::after($this->filter, '-');

            $this->schools = $this->schoolsRepository->findBy([$category => $criteria])->orderBy($column, $direction);
        }



        $this->template->schools = $this->schools;

        $accepts = $this->acceptsRepository->findAll()->orderBy("obor", "ASC");
        $this->template->accepts = $accepts;

        $acceptsYears = $this->acceptsRepository->findAll()->orderBy("rok", "ASC");
        $this->template->acceptsYears = $acceptsYears;
    }

    public function handleSort(String $sort): void
    {
        $this->sort = $sort;
    }

    protected function createComponentFilterForm(): Form
    {
        $form = new Form;

        $form->addGroup('Škola');
        $schoolsArray = [];
        $schools = $this->schoolsRepository->findAll()->orderBy("nazev", "ASC");
        foreach ($schools as $school) {
            $schoolsArray += [$school->nazev => $school->nazev];
        }
        $form->addRadioList('school', '', $schoolsArray);

        $form->addGroup('Město');
        $townsArray = [];
        $towns = $this->townsRepository->FindAll();
        foreach ($towns as $town) {
            $townsArray += [$town->id => $town->nazev];
        }
        $form->addRadioList('town', '', $townsArray);

        $form->addSubmit('send', 'Filtrovat');
        $form->makeBootstrap4($form);

        $form->onSuccess[] = [$this, 'FilterformSucceeded'];
        return $form;
    }

    public function FilterformSucceeded(Form $form, $data): void
    {
        if ($data->school != null) {
            $category = "nazev";
            $criteria = $data->school;
        } else {
            $category = "mesto";
            $criteria = $data->town;
        }

        $this->filter = $category . "-" . $criteria;
        if ($data->school == null && $data->town == null) {
            $this->filter = "all";
        }
        $this->flashMessage('Obsah byl filtrován.');
    }

    protected function createComponentSchoolAddForm(): Form
    {
        $form = new Form;

        $form->addText("nazev", "Název:");
        $townsArray = [];
        $towns = $this->townsRepository->FindAll();
        foreach ($towns as $town) {
            $townsArray += [$town->id => $town->nazev];
        }
        $form->addSelect("mesto", "Město:", $townsArray);
        $form->addText("glat", "Geo_lat:");
        $form->addText("glong", "Geo_long:");

        $form->addSubmit('send', 'Vložit');
        $form->makeBootstrap4($form);

        $form->onSuccess[] = [$this, 'SchoolAddformSucceeded'];
        return $form;
    }

    public function SchoolAddformSucceeded(Form $form, $data): void
    {
        $mesto = $this->townsRepository->getBy(["id" => $data["mesto"]]);

        $this->schoolsRepository->add($data, $mesto);
        $this->flashMessage('Škola byla vložena.');
    }


    protected function createComponentAcceptAddForm(): Form
    {
        $form = new Form;


        $professionsArray = [];
        $professions = $this->professionsRepository->FindAll();
        foreach ($professions as $profession) {
            $professionsArray += [$profession->id => $profession->nazev];
        }
        $form->addSelect("obor", "Obor:", $professionsArray);
        $schoolsArray = [];
        $schools = $this->schoolsRepository->FindAll()->orderBy("nazev", "ASC");
        foreach ($schools as $school) {
            $schoolsArray += [$school->id => $school->nazev];
        }
        $form->addSelect("skola", "Město:", $schoolsArray);

        $form->addText("pocet", "Počet:");
        $form->addText("rok", "Rok:");

        $form->addSubmit('send', 'Vložit');
        $form->makeBootstrap4($form);

        $form->onSuccess[] = [$this, 'AcceptAddformSucceeded'];
        return $form;
    }

    public function AcceptAddformSucceeded(Form $form, $data): void
    {
        $skola = $this->schoolsRepository->getBy(["id" => $data["skola"]]);
        $obor = $this->professionsRepository->getBy(["id" => $data["obor"]]);
        $this->acceptsRepository->add($data, $skola, $obor);

        $this->flashMessage('Záznam byl přidán.');
    }
}
